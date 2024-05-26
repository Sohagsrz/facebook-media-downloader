<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6d86d189b9c6682cc9e485e1acaa1e95
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Sohagsrz\\Fbmediadownloader\\' => 27,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Sohagsrz\\Fbmediadownloader\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6d86d189b9c6682cc9e485e1acaa1e95::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6d86d189b9c6682cc9e485e1acaa1e95::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6d86d189b9c6682cc9e485e1acaa1e95::$classMap;

        }, null, ClassLoader::class);
    }
}
