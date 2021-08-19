# Laravel MVC Code for Scheduler Comparison

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Pre-requisites
* [Composer](https://getcomposer.org) that is vital to install Laravel & related PHP dependencies
* npm & NodeJS that is vital to install Vue & related JS Dependency (including Jest)
* LAMP Stack Application like XAMPP or MAMP (Must handle MySQL)

## Pre-setups
``` bash
# Install PHP dependencies
composer install
# Generate the Application Key for .env
php artisan key:generate
# Copy the example .env file for the system to reference of
cp .env.example .env # Open .env and insert generated Application Key & MySQL Database configs
# Install JS Dependencies
npm install          
```
Create the Database via the Stack Application's MyPHPAdmin 

``` bash
# Migrate the tables over to MySQL DB
php artisan migrate:refresh --seed
```
## To run
``` bash
# Run Laravel Mix to compile the JS and CSS/SASS files
npm run watch 
# Run Laravel itself
php artisan serve
```
## To Test
``` bash
# MUST HAVE PHP DEPENDENCIES INSTALLED & Stack running
vendor/bin/phpunit
# Note: Any tests pertaining E stating Connection Refused is MySQL credentials and/or running
```
---------------
## About Laravel
Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
