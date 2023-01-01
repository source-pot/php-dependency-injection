<?php

namespace SourcePot\Vehicle;

class Boat
{
    public function __construct(
        private Engine $engine,
    ) {
        echo "Instantiating BOAT\n";
    }
}
