Clear-Host
composer update
php artisan migrate:refresh
php artisan db:seed --class=PermissionTableSeeder
php artisan db:seed --class=CreateRolesTableSeeder
php artisan db:seed --class=CreateExamplesSeeder
php artisan serve