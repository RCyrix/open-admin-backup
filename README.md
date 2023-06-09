# Open Admin Backup
## Backup Helper for Open Admin

[![N|512x397,20%](https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSGGTKg-5QFG8Ttxd3kL7CtR7xm2G0eECpATagoLSjUrVUV0wwxcCRe3ssBvGZi5e_GHQ&usqp=CAU)](https://open-admin.org)



A vanilla javascript implementation of Laravel-Admin-Backup extension

JQuery has been stripped, open-admin-backup config file added for config values

##### Make Backups of your Open Admin Application
- Files
- Code
- ✨Database Schema and Data✨

## Requirements

- MySQL || PostGreSQL
- Spatie Laravel Backup
- https://spatie.be/docs/laravel-backup/v8/installation-and-setup
- This extension

Installation is relatively simple

Install Laravel Spatie with

``` composer require spatie/laravel-backup ```

``` php artisan vendor:publish --provider="Spatie\Backup\BackupServiceProvider" ```
> This will install the required libraries from Spatie and publish assets
>
> (In this case a config file : backup.php)

Please let me know if there's an issue installing!

Tested on MySQL (PostGreSQL should work in theory have not yet tested but will soon)

Does NOT work with T-SQL (Microsoft SQL)

To install locally add the following to composer.json of main project

``` 
"repositories": [
        {
            "type": "path",
            "url": "app/Admin/Extensions/open-admin-ext/open-admin-backup"
        }
    ] 
```

```  composer require open-admin-ext/open-admin-backup:dev-main ```

```  php artisan vendor:publish --provider=OpenAdmin\Backup\BackupServiceProvider ```

``` php artisan admin:import open-admin-backup ```
