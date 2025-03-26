# API REST CON AUTENTICACIÓN USANDO SANCTUM - reciclando.me

## PARTE 1
[Tutorial 1/2](https://www.youtube.com/watch?v=LmMJB3STuU4)
---
### 1.  CREAR PROYECTO Y ECHARLO A ANDAR
1. `laravel new api-crud-sanctum` -> `breeze` -> `api` -> etc.
2. Comentar la ruta que hay inicialmente en routes/api.php (la del middleware sanctum) y crear debajo la ruta que devuelve 'API'.
3. en routes/web.php borrar la ruta que hay inicialmente.
4. Para ver las rutas: `php artisan route:list`. Ver con Thunder Client lo que devuelve la ruta creada en api.php (la primera de la lista). Para ello, `php artisan serve` y pegar en Thunder Client la URL con el método GET, seguida de /api (http://127.0.0.1:8000/api) para ver que devuelve "API".
