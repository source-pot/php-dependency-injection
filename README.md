# php-dependency-injection
A PHP implementation of a Container object that automatically builds other objects, autowiring them with dependencies.

Built using plain PHP, no other framework or dependencies.

Based on [PSR-11](https://www.php-fig.org/psr/psr-11/).

Due to limitations in PHP itself, variables like `string` and `int` can't be autowired so they cannot be used in constructors.  The preferred way to get around this is to ensure that constructors only use other classes for dependency injection, then provide other methods to populating string values separately.

Note: This is a simple implementation, it does not support union types (`ClassOne|ClassTwo`), nor does it handle default values (`int $i = 0`)

## usage
First, ensure you have a suitable autoloader set up.  A basic implementation is provided in this demo (see `SourcePot\Autoloader.php`).

For a bigger demo, see `demo.php` in this repository.

Usage:
```
<?php

$container = new Container();
$class = $container->get('FullyQualified\ClassName');
```


## includes
* PHP 8.2 Docker environment
    * Run `docker compose up -d` to start the container
    * Run `docker compose exec php bash` to enter a bash terminal in the container where you can manually run php commands, for example `php demo.php`
* A basic autoloader to find files containing classes
* A demo file that shows the Dependency Injection in use (`demo.php`)
* PSR interfaces for classes created for the Dependency Injection features (see [PHP-FIG](https://www.php-fig.org/psr/psr-11/) for more details)