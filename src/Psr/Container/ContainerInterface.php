<?php

namespace Psr\Container;

interface ContainerInterface
{
    // @throws ContainerExceptionInterface
    public function get(string $identifier): mixed;
    
    // @throws ContainerExceptionInterface
    public function has(string $identifier): bool;
}