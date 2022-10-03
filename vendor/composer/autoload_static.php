<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7d82d99c902fd12ff126bc5818931365
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Mralgorithm\\LaravelJsLang\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Mralgorithm\\LaravelJsLang\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit7d82d99c902fd12ff126bc5818931365::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7d82d99c902fd12ff126bc5818931365::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7d82d99c902fd12ff126bc5818931365::$classMap;

        }, null, ClassLoader::class);
    }
}