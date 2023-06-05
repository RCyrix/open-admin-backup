<?php

namespace OpenAdmin\Backup\Http\Controllers;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use OpenAdmin\Admin\Layout\Content;
use Illuminate\Routing\Controller;
use OpenAdmin\Backup\Backup;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Admin;
class BackupController extends Controller
{
    public function __construct()
    {
        Admin::js('vendor/open-admin-ext/open-admin-backup/backup.js');
    }

    public function index(Content $content)
    {
        return Admin::content(function (Content $content) {
            $backup = new Backup();
            $content->header('Backup');
            $content->body(view('open-admin-backup::index', ['backups' => $backup->getExists(),]));
        });
    }

    /**
     * Download a backup zip file.
     *
     * @param Request $request
     *
     * @return ResponseFactory|BinaryFileResponse|Response
     */
    public function download(Request $request)
    {
        $file = $request->get('file');
        return response()->download(new \SplFileInfo(storage_path('/app' . '/' . $file)));
    }

    /**
     * Run `backup:run` command.
     *
     * @return JsonResponse
     */
    public function run()
    {
        try {
            ini_set('max_execution_time', config('open-admin-backup.max_execution_time'));
            // start the backup process
            Artisan::call('backup:run');
            $output = Artisan::output();
            return response()->json(['status' => true, 'message' => $output]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Delete a backup file.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function delete(Request $request)
    {
        $configuredDisk = config('open-admin-backup.backup-disk');
        $disk = Storage::disk($configuredDisk);
        $file = $request->get('file');

        if ($disk->exists($file)) {
            $disk->delete($file);
            return response()->json(['status' => true, 'message' => trans('admin.delete_succeeded'),]);
        }
        return response()->json(['status' => false, 'message' => trans('admin.delete_failed'),]);
    }
}
