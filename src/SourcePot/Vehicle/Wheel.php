<?php

namespace SourcePot\Vehicle;

class Wheel
{
    public function __construct(private Tyre $tyre)
    {
        echo "Instantiating WHEEL\n";
    }
}
