<?php

namespace SourcePot;

class Autoloader
{
    public static function register(): void
    {
        spl_autoload_register(['SourcePot\Autoloader', 'autoload']);
    }

    public static function autoload(string $className): void
    {
        // transform 'SourcePot\Namespace/Class'
        // into 'SourcePot/Namespace/Class.php'
        $filename = str_replace('\\', '/', $className) . '.php';

        if (file_exists($filename)) {
            include $filename;
        }
    }
}
