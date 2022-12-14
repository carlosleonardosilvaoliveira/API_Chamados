<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit56b3236f13487ec21fe776f265489a65
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit56b3236f13487ec21fe776f265489a65::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit56b3236f13487ec21fe776f265489a65::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit56b3236f13487ec21fe776f265489a65::$classMap;

        }, null, ClassLoader::class);
    }
}
