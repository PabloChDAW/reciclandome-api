# DOCUMENTACIÓN DE LA API
Ejemplos de JSON (en el body) de entrada y respuestas, endpoints y métodos de la API. Usar para probar la API y como referencia de las respuestas que recibirá el cliente.
---
## Registrar un usuario
- Método: POST
- URI: api/register
- Función del controlador: register()
- Entrada de datos:
```json
{
  "name": "Pepito",
  "email": "pepito@mail.com",
  "password": "1111",
  "password_confirmation": "1111"
}
```
- Respuesta:
```json
{
  "user": {
    "name": "Pepito",
    "email": "pepito@mail.com",
    "updated_at": "2025-05-06T15:34:28.000000Z",
    "created_at": "2025-05-06T15:34:28.000000Z",
    "id": 1
  },
  "token": "1|n4Im9NpPctClAKeDae6qJjvLuU3p116Itv0vhT4N1cb7835e"
}
```

## Registrar un producto
- Método: POST
- URI: api/products
- Función del controlador: store()
- Entrada de datos:
```json
{
  "name": "Taza",
  "description": "Una taza",
  "price": 10,
  "stock": 100,
  "image": "(URL de la foto de la taza)"
}
```
- Respuesta:
```json
{
  "name": "Taza",
  "description": "Una taza",
  "price": 10,
  "stock": 100,
  "image": "(URL de la foto de la taza)",
  "updated_at": "2025-05-06T15:37:15.000000Z",
  "created_at": "2025-05-06T15:37:15.000000Z",
  "id": 1
}
```

## Realizar un pedido
- Método: POST
- URI: api/orders
- Función del controlador: store()
- Entrada de datos (es necesario tener al menos dos productos en la base de datos):
```json
{
    "address": "Calle Pernambuco",
    "products": [
        {
            "product_id": 1,
            "quantity": 3
        },
        {
            "product_id": 2,
            "quantity": 5
        }
    ]
}
```
- Respuesta:
```json
{
  "order": {
    "id": 2,
    "user_id": 1,
    "total": "0.00",
    "status": "pending",
    "address": "Calle Pernambuco",
    "created_at": "2025-05-06T17:19:56.000000Z",
    "updated_at": "2025-05-06T17:19:56.000000Z",
    "user": {
      "id": 1,
      "name": "User",
      "email": "user@mail.com",
      "email_verified_at": null,
      "created_at": "2025-05-06T15:34:28.000000Z",
      "updated_at": "2025-05-06T15:34:28.000000Z"
    }
  }
}
```
