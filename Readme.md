# GSES App

## Running the app

```bash
mysql.server start
symfony server:start -d

php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

## Requests

### create user

- url: http://127.0.0.1:8000/user/create
- method: POST
- body:
```json
{
    "firstName": "Rasmus",
    "lastName": "Lerdorf",
    "email": "rasmus.lerdorf@email.com"
}
```


### get all users

- url: http://127.0.0.1:8000/user/list
- method: POST
- body:
```json
{
    "limit": 20,
    "offset": 0
}
```


### get exchange-rate

- url: http://127.0.0.1:8000/exchange-rate/convert
- method: POST
- body:
```json
{
  "sourceCurrency": "usd",
  "targetCurrency": "uah",
  "sourceAmount": 1
}
```
`sourceAmount` - int or float accepted
