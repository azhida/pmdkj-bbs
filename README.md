###### Export | Import data
```
# Export admin menu data
php artisan admin:export-seed --users --except-fields=created_at,updated_at
# Import admin menu data
php artisan db:seed --class=AdminTablesSeeder
```
