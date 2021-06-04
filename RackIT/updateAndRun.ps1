composer update
php artisan migrate:refresh
php artisan db:seed --class=PermissionTableSeeder
php artisan db:seed --class=CreateRolesTableSeeder
php artisan serve