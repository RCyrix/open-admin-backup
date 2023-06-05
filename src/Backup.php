<?php

namespace OpenAdmin\Backup;

use OpenAdmin\Admin\Extension;
use Spatie\Backup\Commands\ListCommand;
use Spatie\Backup\Tasks\Monitor\BackupDestinationStatus;
use Spatie\Backup\Tasks\Monitor\BackupDestinationStatusFactory;

class Backup extends Extension
{
    public $name = 'open-admin-backup';

    public $views = __DIR__.'/../resources/views';

    public $assets = __DIR__.'/../resources/assets';

    public $menu = [
        'title' => 'Backup',
        'path'  => 'open-admin-backup',
        'icon'  => 'icon-cogs',
    ];

    public function getExists()
    {
        $statuses = BackupDestinationStatusFactory::createForMonitorConfig(config('backup.monitor_backups'));

        $listCommand = new ListCommand();

        $rows = $statuses->map(function (BackupDestinationStatus $backupDestinationStatus) use ($listCommand) {
            return $listCommand->convertToRow($backupDestinationStatus);
        })->all();

        foreach ($statuses as $index => $status) {
            $name = $status->backupDestination()->backupName();

            $files = array_map('basename', $status->backupDestination()->disk()->allFiles($name));

            $rows[$index]['files'] = array_slice(array_reverse($files), 0, 30);
        }

        return $rows;
    }

}
