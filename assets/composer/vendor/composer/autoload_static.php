<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitccdad03f4dc99ae46b469ad77079f231
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitccdad03f4dc99ae46b469ad77079f231::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitccdad03f4dc99ae46b469ad77079f231::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitccdad03f4dc99ae46b469ad77079f231::$classMap;

        }, null, ClassLoader::class);
    }
}