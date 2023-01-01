<?php

use SourcePot\DependencyInjection\Container;

require __DIR__ . '/SourcePot/Autoloader.php';

SourcePot\Autoloader::register();

/**
 * Dependency injection container demo
 */

try {
    $dependencyTree = json_decode(file_get_contents('dependency-tree.json'), true);
    // Create a container
    $container = new Container($dependencyTree, false);
    // Request a class from the container

    $car = $container->get(SourcePot\Vehicle\Car::class);
    $car2 = $container->get(SourcePot\Vehicle\Car::class);
    $bicycle = $container->get(SourcePot\Vehicle\Bicycle::class);
    $boat = $container->get(SourcePot\Vehicle\Boat::class);

} catch (\Throwable $t) {
    echo "{$t->getMessage()}\n";
}
