<?php

namespace SourcePot\DependencyInjection;

use Psr\Container\NotFoundExceptionInterface;

class NotFoundException
    extends \RuntimeException
    implements NotFoundExceptionInterface {}
