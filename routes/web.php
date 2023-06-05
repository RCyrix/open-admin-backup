<?php

use OpenAdmin\Backup\Http\Controllers\BackupController;

Route::get('open-admin-backup', BackupController::class.'@index');

#Database Backup
Route::get('backup',          BackupController::class.'@index')->name('backup-list');
Route::get('backup/download', BackupController::class.'@download')->name('backup-download');
Route::post('backup/run',      BackupController::class.'@run')->name('backup-run');
Route::delete('backup/delete',   BackupController::class.'@delete')->name('backup-delete');

