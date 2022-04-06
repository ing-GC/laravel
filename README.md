

## Config

- Modify the .env
```
QUEUE_CONNECTION=sync for QUEUE_CONNECTION=database
```
- Run
```
php artisan queue:table
```
```
php artisan migrate
```
```
php artisan queue work
```


