<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitab3c22bf74f66613295709bb3b059f13
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitab3c22bf74f66613295709bb3b059f13::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitab3c22bf74f66613295709bb3b059f13::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitab3c22bf74f66613295709bb3b059f13::$classMap;

        }, null, ClassLoader::class);
    }
}
