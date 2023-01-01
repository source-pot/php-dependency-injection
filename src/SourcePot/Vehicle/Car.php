<?php

namespace SourcePot\Vehicle;

class Car
{
    public function __construct(
        private Engine $engine,
        private Wheel $frontLeftWheel,
        private Wheel $frontRightWheel,
        private Wheel $rearLeftWheel,
        private Wheel $rearRightWheel,
    ) {
        echo "Instantiating CAR\n";
    }
}
