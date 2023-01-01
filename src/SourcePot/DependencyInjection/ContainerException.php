<?php

namespace SourcePot\DependencyInjection;

use Psr\Container\ContainerExceptionInterface;

class ContainerException
    extends \RuntimeException
    implements ContainerExceptionInterface {}
