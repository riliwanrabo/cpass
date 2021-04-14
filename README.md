# laravel-api-boilerplate

This is a boilerplate for writing RESTful API projects using Laravel, a "Starter Kit" you can use to build your API in seconds.

##### Packages:

* JWT-Auth - [tymondesigns/jwt-auth](https://github.com/tymondesigns/jwt-auth)
* Laravel-CORS [barryvdh/laravel-cors](http://github.com/barryvdh/laravel-cors)

##### Require:
* PHP: ^7.3 | ^8.0

## Features

* JWT Authentication
* Basic Features: Registration, Login, Update Profile & Password
* JSON API Format response.
* Unit/Feature Testing.



## Installation
`composer create-project riliwanrabo/laravel-api-boilerplate myNewProject`;


#### Install Dependencies

```
$ composer install
```

#### Configure the Environment
Create `.env` file:
```
$ cat .env.example > .env
```
Run `php artisan key:generate` and `php artisan jwt:secret`

#### Migrate and Seed the Database
```
$ php artisan migrate:fresh --seed
```


## Route API Endpoint
* Postman API Documentation Starter Kit https://documenter.getpostman.com/view/880526/SVtN3BkG?version=latest

| Verb     |                     URI                          |       Controller          |      Notes                                |
| -------- | -----------------------------------------------  | -----------------------   | ------------------------------------------
| POST     | `http://localhost:8000/api/auth/login`              |  AuthController           | to do the login and get your access token
| POST     | `http://localhost:8000/api/auth/register`          |  RegisterController       | to create a new user into your application
| POST     | `http://localhost:8000/api/auth/recovery`          |  ForgotPasswordController | to recover your credentials;
| POST     | `http://localhost:8000/api/auth/reset`             |  ResetPasswordController  | to reset your password after the recovery (setup your mail credentials in `.env` file to avoid error);
| POST     | `http://localhost:8000/api/auth/logout`            |  LogoutController         | to log out the user by invalidating the passed token;
| GET      | `http://localhost:8000/api/profile`           |  ProfileController        | to get current user data
| PUT      | `http://localhost:8000/api/profile`           |  ProfileController        | to update current user data
| PUT      | `http://localhost:8000/api/profile/password`  |  ProfileController        | to update current user password

