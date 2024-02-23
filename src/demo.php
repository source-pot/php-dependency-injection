<?php

use SourcePot\DependencyInjection\Container;

require 'Autoloader.php';
Autoloader::register('vendor');

/**
 * Dependency injection container demo
 */

try {
    /**
     * Demonstrate loading a json file with some dependencies already configured
     */
    $dependencyTree = json_decode(file_get_contents('dependency-tree.json'), associative: true);
    $container = new Container($dependencyTree);
    
    // Request some classes from the container as an example
    $car = $container->get(SourcePot\Vehicle\Car::class);
    $car2 = $container->get(SourcePot\Vehicle\Car::class);
    $bicycle = $container->get(SourcePot\Vehicle\Bicycle::class);
    $boat = $container->get(SourcePot\Vehicle\Boat::class);

    // This special case has no constructor on itself, but the parent class does.
    echo "Instantiating FordMondeo\n";
    $fordMondeo = $container->get(SourcePot\Vehicle\FordMondeo::class);

} catch (\Throwable $t) {
    echo "{$t->getMessage()}\n";
}
