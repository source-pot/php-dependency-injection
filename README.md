# php-dependency-injection
A PHP implementation of a Container object that automatically builds other objects, autowiring them with dependencies.

Built using plain PHP, no other framework or dependencies.

Based on [PSR-11](https://www.php-fig.org/psr/psr-11/).

Due to limitations in PHP itself, variables like `string` and `int` can't be autowired so they cannot be used in constructors.  The preferred way to get around this is to ensure that constructors only use other classes for dependency injection, then provide other methods to populating string values separately.

Note: This is a simple implementation, it does not support union types (`ClassOne|ClassTwo`), nor does it handle default values (`int $i = 0`)

## Usage
First, ensure you have a suitable autoloader set up.  A basic implementation is provided in this demo (see `SourcePot\Autoloader.php`).

For a bigger demo, see `demo.php` in this repository.

### Code example:
```php
<?php

$container = new Container();
// uses PHP's Reflection API to build the dependencies
$class = $container->get('FullyQualified\ClassName');

// Or provide an array of class dependencies directly to improve performance:
$container = new Container($classMap);
// consults the classMap first to see if it already knows how to build this class.
// Falls back to PHP's Reflection API otherwise
$class = $container->get('FullyQualified\ClassName');

// Instruct the container to not use the Reflection API:
$container = new Container($classMap, false);
// consults the classMap, otherwise throws an Exception
$class = $container->get('FullyQualified\ClassName');
```

### Classmap injection:
To save additional checks with the Reflection API, you can pass an array into the Container constructor.  
This will be consulted first, before invoking the Reflection API.   This does mean that if a class has new dependencies
not mentioned in the classMap, an error will occur (unless the other dependencies have default values).
```php
<?php

$classMap = [
    \\FullyQualified\\ClassName' => [
        '\\Dependency\\First',
        '\\Dependency\\Second'
    ]
];

$container = new Container($classMap);

$container->get(\FullyQualified\Class::class);
```
