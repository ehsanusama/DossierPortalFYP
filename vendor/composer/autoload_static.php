<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5c590fb047b7afb511b4b09c49d79739
{
    public static $prefixesPsr0 = array (
        'E' => 
        array (
            'Endroid' => 
            array (
                0 => __DIR__ . '/..' . '/endroid/qrcode/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit5c590fb047b7afb511b4b09c49d79739::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}