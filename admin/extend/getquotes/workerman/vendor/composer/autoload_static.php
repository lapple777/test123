<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitce9123e91f78b3320b5590304668a260
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Workerman\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Workerman\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitce9123e91f78b3320b5590304668a260::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitce9123e91f78b3320b5590304668a260::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
