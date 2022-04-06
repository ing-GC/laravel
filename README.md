

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
```
php artisan make:post 10
```

- Question 4 & 5

4. Es un proceso de confiabilidad e integridad, se requiere que las peticiones lleguen a su destino de manera satisfactoria independietemente si se ejecutan de manera correcta o no.
<br>
5. Es un proceso de performance y tolerancia a fallos, se debe ser capaz de seguir funcionando en este caso si una petición falla, seguir ejecutando las siguientes y reportar el porque del fallo para corregir el posible error, pudiendo repetir dicha petición de manera sencilla sin afectar la ejecución de las otras peticiones.