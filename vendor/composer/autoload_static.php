<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit96b73cf41aab32f2a1b70ff924265e3c
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit96b73cf41aab32f2a1b70ff924265e3c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit96b73cf41aab32f2a1b70ff924265e3c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit96b73cf41aab32f2a1b70ff924265e3c::$classMap;

        }, null, ClassLoader::class);
    }
}
