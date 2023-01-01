<?php

namespace SourcePot\DependencyInjection;

use Psr\Container\ContainerInterface;
use ReflectionClass, ReflectionNamedType;

class Container implements ContainerInterface
{
    public function __construct(
        private array $classMap = [],
        private bool $enableAutowire = true,
    ) {
    }

    public function get(string $identifier): mixed
    {
        if (!$this->has($identifier)) {
            throw new NotFoundException("Class $identifier does not exist");
        }

        if (!$this->cached($identifier)) {
            if (!$this->enableAutowire) {
                throw new NotFoundException("Unable to autowire $identifier");
            }
            $this->resolveDependencies($identifier);
        }

        // Instantiate each of the dependencies using this method recursively
        $dependencies = array_map(
            fn($dependency) => $this->get($dependency),
            $this->classMap[$identifier]
        );

        // Then create a new instance of the requested class with its dependencies passed in
        return new $identifier(...$dependencies);
    }

    public function has(string $identifier): bool
    {
        // Use the autoloader to attempt to load the class
        return class_exists($identifier, true);
    }

    private function cached(string $identifier): bool
    {
        return array_key_exists($identifier, $this->classMap);
    }

    private function resolveDependencies(string $identifier): void
    {
        $deps = $this->getDependencies($identifier);
        $this->classMap[$identifier] = $deps;
    }

    private function getDependencies(string $identifier): array
    {
        // return an array of class names that are dependencies of the
        // given classes constructor
        $deps = [];

        try {
            $reflectionClass = new ReflectionClass($identifier);
        } catch (\Throwable $t) {
            throw new ContainerException($t->getMessage());
        }

        if (!$reflectionClass->isInstantiable()) {
            throw new ContainerException(
                "Class $identifier cannot be instantiated"
            );
        }

        $constructor = $reflectionClass->getConstructor();

        // No constructor, no dependencies
        if ($constructor === null) {
            return $deps;
        }

        $parameters = $constructor->getParameters();

        foreach($parameters as $param) {
            $name = $param->getName();
            $type = $param->getType();

            if ($type === null) {
                throw new ContainerException(
                    "Parameter $name of $identifier: invalid parameter type (1)"
                );
            }

            if (!$type instanceof ReflectionNamedType) {
                throw new ContainerException(
                    "Parameter $name of $identifier: invalid parameter type (2)"
                );
            }

            if ($type->isBuiltIn()) {
                throw new ContainerException(
                    "Parameter $name of $identifier: invalid parameter type (3)"
                );
            }

            $deps[] = $type->getName();
        }

        return $deps;
    }
}
