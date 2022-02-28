# jwt-lumen

Implementation JSON Web Token for Authentication in Laravel Lumen

## Installation

Use the package manager [composer](https://getcomposer.org/) to install the dependency.

```bash
composer update
```
set your `.env` file by copying `.env.example` and set up your database config.

## Database Migratio

```bash
php artisan migrate
```

## Generate key

```bash
php artisan key:generate
php artisan jwt:secret
```

## Seed dummy database product

```bash
php artisan db:seed
```

## running

```bash
php artisan serve
```

## endpoint
URL endpoint `HTTP://localhost:8000/api/`

## Register
Method POST `/register`

#### Body
```javascript
{
	"name":"Your name",
	"email":"yourmail@gmail.com",
	"email_confirmation":"yourmail@gmail.com",
	"password":"123456"
}
```

## Login
Method POST `/login`

#### Body
```javascript
{
	"email":"yourmail@gmail.com",
	"password":"123456"
}
```

## Product
Method GET `/product`

#### Header
```javascript
{
	"Authorization":"Bearer [your_token]"
}
```

## Product Create
Method POST `/product`

#### Header
```javascript
{
	"Authorization":"Bearer [your_token]"
}
```

#### Body
```javascript
{
	"nama":"Product Name",
	"harga":price,
	"jumlah":count
}
```

## Logout
Method POST `/logout`

#### Header
```javascript
{
	"Authorization":"Bearer [your_token]"
}
```