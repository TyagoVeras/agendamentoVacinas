PREVIEW PACIENTE

![image](https://user-images.githubusercontent.com/5241040/122974757-10b11680-d369-11eb-919b-fc2c7d935df8.png)

![image](https://user-images.githubusercontent.com/5241040/122974819-1e669c00-d369-11eb-9387-a5d512d525f7.png)

![image](https://user-images.githubusercontent.com/5241040/122974915-34745c80-d369-11eb-9cff-a770bdef9c7f.png)

![image](https://user-images.githubusercontent.com/5241040/122975297-9634c680-d369-11eb-852c-dd1b73f78149.png)

![image](https://user-images.githubusercontent.com/5241040/122975439-b8c6df80-d369-11eb-92af-def298f64c07.png)


PREVIEW ADMINISTRADOR

![image](https://user-images.githubusercontent.com/5241040/122975523-ced4a000-d369-11eb-9445-e34d8b33ef1c.png)

![image](https://user-images.githubusercontent.com/5241040/122975573-dd22bc00-d369-11eb-901e-7b3db64b2a18.png)

![image](https://user-images.githubusercontent.com/5241040/122975659-f6c40380-d369-11eb-99df-ac5a54b7f0cf.png)

![image](https://user-images.githubusercontent.com/5241040/122975711-07747980-d36a-11eb-9efd-3b7153ff4eeb.png)

![image](https://user-images.githubusercontent.com/5241040/122975755-12c7a500-d36a-11eb-940b-a589b942b489.png)



# CakePHP Application Skeleton

![Build Status](https://github.com/cakephp/app/actions/workflows/ci.yml/badge.svg?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/cakephp/app.svg?style=flat-square)](https://packagist.org/packages/cakephp/app)
[![PHPStan](https://img.shields.io/badge/PHPStan-level%207-brightgreen.svg?style=flat-square)](https://github.com/phpstan/phpstan)

A skeleton for creating applications with [CakePHP](https://cakephp.org) 4.x.

The framework source code can be found here: [cakephp/cakephp](https://github.com/cakephp/cakephp).

## Installation

1. Download [Composer](https://getcomposer.org/doc/00-intro.md) or update `composer self-update`.
2. Run `php composer.phar create-project --prefer-dist cakephp/app [app_name]`.

If Composer is installed globally, run

```bash
composer create-project --prefer-dist cakephp/app
```

In case you want to use a custom app dir name (e.g. `/myapp/`):

```bash
composer create-project --prefer-dist cakephp/app myapp
```

You can now either use your machine's webserver to view the default home page, or start
up the built-in webserver with:

```bash
bin/cake server -p 8765
```

Then visit `http://localhost:8765` to see the welcome page.

## Update

Since this skeleton is a starting point for your application and various files
would have been modified as per your needs, there isn't a way to provide
automated upgrades, so you have to do any updates manually.

## Configuration

Read and edit the environment specific `config/app_local.php` and setup the 
`'Datasources'` and any other configuration relevant for your application.
Other environment agnostic settings can be changed in `config/app.php`.

## Layout

The app skeleton uses [Milligram](https://milligram.io/) (v1.3) minimalist CSS
framework by default. You can, however, replace it with any other library or
custom styles.
