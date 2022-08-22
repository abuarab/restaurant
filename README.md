# Lumen PHP Framework
# Restaurant api

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://img.shields.io/packagist/l/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

### Overview

This project includes an api for restaurant where the client request an order and receive response.

## Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).

### Contributing

Thank you for considering contributing to Lumen! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

### Requirements and dependencies
+ PHP >= 7.3
+ Lumen version is 8.3.4
+ Laravel Passport

### Installation
+ Clone the repo
+ `composer install`
+ Run `$ cp .env.example .env` and set database credentials
+ `php artisan migrate`
+ `php artisan passport:install`
+ Set `PASSPORT_LOGIN_ENDPOINT` , `PASSPORT_CLIENT_ID`, `PASSPORT_CLIENT_SECRET` and `PASSPORT_GRANT_TYPE `  in your `.env` file
+ `php artisan db:seed`
+ For testing order `vendor/phpunit/phpunit/phpunit`

### Logins
After migration you can login with client user:
 + client@restaurant.com
 + password <br />
 You have also an admin email, you can just update this email from database to receive notification emails. <br />
  + admin@restaurant.com
  + password <br />
 

### Api calls 
   Http method   |    Path       | Fields        | Description
   ------------- | ------------- | ------------- | -------------
   post  | /api/login            | `email`, `password`  | Admin/client login
   post  | /api/register         | `first_name`, `last_name`, `email`, `password`  | Client Registration
   post  | /api/order         | `product_id`, `quantity`  | Create an order
   

### Login and registration
#### Login
![image!](re_images/login.png)
#### registration
![image!](re_images/registration.png)
### Order creation
#### Successful order
![image!](re_images/order.png)
#### Failed order
![image!](re_images/order2.png)
#### Email notification
![image!](re_images/email_notification.png)

### Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

### License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
