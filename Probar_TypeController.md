Para probar en thunderclient TypeController:

CHULETA PARA TYPECONTROLLER Y SUS MÉTODOS NUEVOS (JAVI)


POST->
```json
{
  "name": "Restaurante",
  "description": "Lugares para comer",
  "icon": "️Icono de comida",
  "point_id": [1, 2]  
}
```
- Respuesta:
```json
{
  "name": "Restaurante",
  "description": "Lugares para comer",
  "icon": "️Icono de comida",
  "updated_at": "2025-05-08T06:46:40.000000Z",
  "created_at": "2025-05-08T06:46:40.000000Z",
  "id": 1,
  "points": []
}
```

-Listar todos los tipos con puntos (GET):


-Respuesta
```json
[
  {
    "id": 1,
    "name": "Restaurante",
    "description": "Lugares para comer",
    "icon": "️Icono de comida",
    "created_at": "2025-05-08T06:46:40.000000Z",
    "updated_at": "2025-05-08T06:46:40.000000Z"
  }
]
```

-Probar por id (types/{id})
Method: GET
Respuesta
```json
{
  "id": 1,
  "name": "Restaurante",
  "description": "Lugares para comer",
  "icon": "️Icono de comida",
  "created_at": "2025-05-08T06:46:40.000000Z",
  "updated_at": "2025-05-08T06:46:40.000000Z",
  "points": []
}

```

-Actualizar (PUT)
- URI:[api/types/1]
```json
{
  "name": "Cafetería",
  "description": "Para tomar café",
  "icon": "Icono de café",
  "point_id": [1]
}
```

-Respuesta:

```json
{
  "id": 1,
  "name": "Cafetería",
  "description": "Para tomar café",
  "icon": "Icono de café",
  "created_at": "2025-05-08T06:46:40.000000Z",
  "updated_at": "2025-05-08T06:52:45.000000Z",
  "points": []
}
```

Obtener los puntos de un tipo:

http://127.0.0.1:8000/api/types/1/points
Method:GET
Repuesta:

[]

Obtener puntos por tipo:


http://127.0.0.1:8000/api/points/1/with-types

Method: GET

Respuesta:
```json
{
  "point": {
    "id": 1,
    "user_id": 1,
    "latitude": "40.41680000",
    "longitude": "-3.70380000",
    "city": "Madrid",
    "address": "Calle Mayor",
    "telephone": "123456789",
    "email": "ejemplo@mail.com",
    "url": "https://ejemplo.com",
    "created_at": "2025-05-08T06:57:39.000000Z",
    "updated_at": "2025-05-08T06:57:39.000000Z",
    "user": {
      "id": 1,
      "name": "Javi",
      "email": "javi@jssdasddddddaddvi.com",
      "email_verified_at": null,
      "created_at": "2025-05-08T06:57:30.000000Z",
      "updated_at": "2025-05-08T06:57:30.000000Z"
    },
    "types": []
  },
  "user": {
    "id": 1,
    "name": "Javi",
    "email": "javi@jssdasddddddaddvi.com",
    "email_verified_at": null,
    "created_at": "2025-05-08T06:57:30.000000Z",
    "updated_at": "2025-05-08T06:57:30.000000Z"
  },
  "types": []
}

```

Por ultimo:


http://127.0.0.1:8000/api/points-with-types

Method: GET


Respueta:
```json
[
  {
    "id": 1,
    "user_id": 1,
    "latitude": "40.41680000",
    "longitude": "-3.70380000",
    "city": "Madrid",
    "address": "Calle Mayor",
    "telephone": "123456789",
    "email": "ejemplo@mail.com",
    "url": "https://ejemplo.com",
    "created_at": "2025-05-08T06:57:39.000000Z",
    "updated_at": "2025-05-08T06:57:39.000000Z",
    "user": {
      "id": 1,
      "name": "Javi",
      "email": "javi@jssdasddddddaddvi.com",
      "email_verified_at": null,
      "created_at": "2025-05-08T06:57:30.000000Z",
      "updated_at": "2025-05-08T06:57:30.000000Z"
    },
    "types": []
  }
]

```