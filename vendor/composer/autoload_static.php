<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb9a76cfa780c159c3d9e1863b4e09127
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitb9a76cfa780c159c3d9e1863b4e09127::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb9a76cfa780c159c3d9e1863b4e09127::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb9a76cfa780c159c3d9e1863b4e09127::$classMap;

        }, null, ClassLoader::class);
    }
}