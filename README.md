# API REST CON AUTENTICACIÓN USANDO SANCTUM - reciclando.me

## PARTE 1
[Tutorial 1/2](https://www.youtube.com/watch?v=LmMJB3STuU4)
---
### 1.  CREAR PROYECTO Y ECHARLO A ANDAR
1. `laravel new api-crud-sanctum` -> `breeze` -> `api` -> etc.
2. Comentar la ruta que hay inicialmente en routes/api.php (la del middleware sanctum) y crear debajo una ruta que devuelve 'API' para probarla:
```php
Route::get('/', function () {
    return 'API';
});
```
3. en routes/web.php borrar la ruta que hay inicialmente.
4. Para ver las rutas: `php artisan route:list`. Ver con Postman lo que devuelve la ruta creada en api.php (la primera de la lista). Para ello, `php artisan serve` y pegar en Postman la URL con el método GET, seguida de /api (http://127.0.0.1:8000/api) para ver que devuelve "API".

### 2. CREAR CRUD
1. Crear modelo Point con todos sus archivos asociados con `php artisan make:model Point -a --api` y añadirle el array fillable con 'longitude' y 'latitude'.
2. En la migración de Point, crear las dos columnas añadidas y migrar con `php artisan migrate`.
3. Definir la ruta apiResource en routes/api.php y borrar la que hicimos de prueba. Listar las rutas y comprobar que con apiResource hemos creado todas las rutas necesarias para el CRUD, incluyendo URL dinámicas para mostrar un point específico.
4. En PointController implementar el método index para que devuelva todos los points (probar en Postman con http://127.0.0.1:8000/api/points por GET).
    Nota: En vez de usar StorePointRequest y UpdatePointRequest usaremos Request (Illuminate\Http\Request), así que los cambiamos en los parámetros de los métodos del controlador y borramos el directorio Http/Requests. De esta manera usaremos Request para todo sin separar en varios ficheros.
5. En PointController implementar el método store para que valide los campos de un point y los guarde en la BD. Probar en Postman por POST.
    Nota: Devolverá 404 porque no hemos puesto el header. Siempre es necesario este header: Key: Accept. Value: application/json. Entonces devolverá 422 porque no ha pasado las validaciones. Añadir un body con un JSON (raw) que pase las validaciones (required):
    ```json
    {
        "longitude": -4.77275,
        "latitude": 37.89155
    }
    ```
     y devolverá un 200 con nuestro "OK".
Para que se guarde el point al usar este método, modificarlo por el definitivo.
    Nota: Ahora si ejecutamos el mismo request en Postman guardará ese point de prueba en la BD.
6. En PointController implementar el método show para que devuelva un point concreto. Probar en Postman pasando el id del point creado anteriormente (http://127.0.0.1:8000/api/points/1 por GET).
7. En PointController implementar el método update que será parecido al método create, excepto que actualizará de manera recursiva un point en vez de crearlo. Probar en Postman pasando el id del point creado anteriormente y modificando los datos del body (http://127.0.0.1:8000/api/points/1 por PUT).
8. En PointController implementar el método destroy y probar borrando el point de prueba con Postman por el método DELETE (sin incluir body, claro).

## PARTE 2
[Tutorial 2/2](https://www.youtube.com/watch?v=7pCDK321ckE)
---
### 1. CREAR CONTROLADOR Y RUTAS DE AUTENTICACIÓN
1. `php artisan make:controller AuthController` y definir las funciones necesarias: register, login y logout para que simplemente devuelvean un string de prueba.
2. Definir las 3 rutas en routes/api.php para que devuelvan un string de prueba, listarlas y probarlas con Postman por POST con el header con key: Accept y Value: application/json.
3. Implementar el método register para que valide los campos de entrada y luego cree al usuario y lo devuelva. Añadir HasApiTokens en el modelo User. De vuelta al método register, crear el token y en el return hacer que devuelva un array asociativo con ambas variables (user y token). Probar con Postman por POST con la propiedad Accept en el header y el JSON con las propiedades necesarias en el body (name, email, password y password_confirmation):
```json
{
    "name": "Pablo",
    "email": "pablo@mail.com",
    "password": "1111",
    "password_confirmation": "1111"
}
```
Veremos que crea un token hasheado. Este es el que el cliente usará para autenticarse comparándolo con el guardado en la BD en la tabla personal_access_tokens:
```json
{
    "user": {
        "name": "Pablo",
        "email": "pablo@mail.com",
        "updated_at": "2025-03-26T19:23:32.000000Z",
        "created_at": "2025-03-26T19:23:32.000000Z",
        "id": 1
    },
    "token": "1|pVRgwxo89jSEiAN0lRumdbJScG98er1WHAycqX3Gdcae9c89"
}
```
4. Copiar las reglas de validación de register en el método login con los cambios necesarios. Capturar al usuario a través de su email con el método where (devuelve un array, así que le aplicamos first para coger al primero y así no tener un array de uno). Comprobar con un if si el usuario no existe o el password no es correcto para devolver un mensaje, y si no se ejecuta el return creamos el token para el usuario y lo devolvemos (similar a register sólo que ya tenemos el usuario, no hay que sacarlo de $request). Probar con Thunder Client por POST (http://127.0.0.1:8000/api/login con el Accept en el header y el email y password en el body).
```json
{
    "email": "pablo@mail.com",
    "password": "1111"
}
```
Devuelve 200 OK:
```json
{
    "user": {
        "id": 1,
        "name": "Pablo",
        "email": "pablo@mail.com",
        "email_verified_at": null,
        "created_at": "2025-03-26T19:23:32.000000Z",
        "updated_at": "2025-03-26T19:23:32.000000Z"
    },
    "token": "2|aOLBdtSazztA5iXHAWciO5SBtn60rMeE8sad8uS2d76fb8af"
}
```
Probar con el email mal y luego el password mal para ver los mensajes de error, y luego bien para ver que registra y devuelve el token.
    - Nota: En la función register de AuthController.php, en el return, cuando devuelve el token no especifiqué que devolviera la propiedad `plainTextToken`. Eso me ha hecho volverme loco cuando me he puesto a recoger el token desde el lado cliente con React. Lo mismo me ha pasado en la función login. He tenido que añadir `plainTextToken` también.
5. Implementar el método logout para que borre los tokens que hayan sido creados para ese usuario y devuelva un mensaje. Probar con Postman por POST (http://127.0.0.1:8000/api/logout con los mismos datos de la prueba anterior). Dará error porque no estamos comprobando si el usuario está logueado o no. Para solucionarlo, proteger la ruta del logout para que sólo sea accesible si el usuario está autenticado con el middleware auth:sanctum e incluir el token en el header (copiarlo de la prueba que hicimos para el login). Recibimos el mensaje "Has cerrado la sesión." y en la BD se han borrado los tokens de acceso.
