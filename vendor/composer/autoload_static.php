<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfa859f75d87f83d5e82471f787c5e804
{
    public static $prefixLengthsPsr4 = array (
        'm' => 
        array (
            'myfrm\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'myfrm\\' => 
        array (
            0 => __DIR__ . '/..' . '/myfrm/core/classes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfa859f75d87f83d5e82471f787c5e804::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfa859f75d87f83d5e82471f787c5e804::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitfa859f75d87f83d5e82471f787c5e804::$classMap;

        }, null, ClassLoader::class);
    }
}