<?php

namespace SourcePot\Vehicle;

class Bicycle
{
    public function __construct(
        private Wheel $frontWheel,
        private Wheel $rearWheel,
    ) {
        echo "Instantiating BICYCLE\n";
    }
}
