# API RESTful con Laravel

## Entorno de Desarrollo
* XAMPP
* php 5.6
* Laravel 5.0
* MySQL 5.4
* Visual Studio Code

## Instalación
1. Instalar XAMPP
2. Instalar Composer

## Configuración de Entorno
1. Configuración archivo hosts
```
127.0.0.1	api-rest
``` 
2. Crear VirtualHost
Modificar archivo httpd-vhost.conf
```
<VirtualHost api-rest:80>
  DocumentRoot "...\xampp\htdocs\api-rest\public"
  ServerAdmin api-rest
  <Directory "...\xampp\htdocs\api-rest">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
  </Directory>
</VirtualHost>
```
## Sobre Laravel


## Proyecto
1. Crear proyecto
```
composer create-project laravel/laravel=5.0 api-rest
```
2. 



## Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/downloads.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
