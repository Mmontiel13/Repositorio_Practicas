<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit65dae77542d7d78ed5457d1971b1d8fb
{
    public static $classMap = array (
        'Account' => __DIR__ . '/../..' . '/app/models/Account.php',
        'AccountController' => __DIR__ . '/../..' . '/app/controllers/AccountController.php',
        'AccountTemplate' => __DIR__ . '/../..' . '/app/views/AccountTemplate.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'User' => __DIR__ . '/../..' . '/app/models/User.php',
        'UserController' => __DIR__ . '/../..' . '/app/controllers/UserController.php',
        'UserTemplate' => __DIR__ . '/../..' . '/app/views/UserTemplate.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit65dae77542d7d78ed5457d1971b1d8fb::$classMap;

        }, null, ClassLoader::class);
    }
}
