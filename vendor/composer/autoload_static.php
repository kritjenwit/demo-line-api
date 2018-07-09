<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit674b6fa072fc578c5f08ab9d8a62878d
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'LINE\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'LINE\\' => 
        array (
            0 => __DIR__ . '/..' . '/linecorp/line-bot-sdk/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit674b6fa072fc578c5f08ab9d8a62878d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit674b6fa072fc578c5f08ab9d8a62878d::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
