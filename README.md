# API SPECIFICATION

-   <a href="auth-endpoint">Auth Endpoint</a><br>

## AUTH ENDPOINT

### REGISTER

Request :

-   Method : POST
-   Endpoint : `/api/register`
-   Header :
    -   Accept: application/json
-   Body :

```json
{
    "name": "string",
    "username": "string",
    "email": "string, email",
    "password": "string",
    "role": "string"
}
```

Response :

```json
{
    "status": "string",
    "message": "string",
    "user": {
        "name": "string",
        "username": "string",
        "email": "string",
        "role": "string",
        "updated_at": "timestamp",
        "created_at": "timestamp",
        "id": "integer"
    },
    "authorisation": {
        "token": "string",
        "type": "string"
    }
}
```

Response if the username consist of special character :

```json
{
    "message": "string",
    "errors": {
        "username": ["string"]
    }
}
```

Response if the username greater than 15 characters :

```json
{
    "message": "string",
    "errors": {
        "username": ["string"]
    }
}
```

Response if the email or username is already registered :

```json
{
    "message": "string",
    "errors": {
        "email": ["string"]
    }
}
```

### LOGIN

Request :

-   Method : POST
-   Endpoint : `/api/login`
-   Header :
    -   Accept: application/json
-   Body :

```json
{
    "email": "string, email",
    "password": "string"
}
```

Response :

```json
{
    "status": "string",
    "user": {
        "id": "integer",
        "name": "string",
        "username": "string",
        "email": "string",
        "email_verified_at": null,
        "role": "string",
        "created_at": "timestamp",
        "updated_at": "timestamp"
    },
    "authorisation": {
        "token": "string",
        "type": "string"
    }
}
```

Response if the email or password doesn't match :

```json
{
    "status": "string",
    "message": "string"
}
```

### LOGOUT

Request :

-   Method : POST
-   Endpoint : `/api/logout`
-   Header :
    -   Accept: application/json
    -   Autohorization: Bearer token

Response :

```json
{
    "status": "string",
    "message": "string"
}
```
