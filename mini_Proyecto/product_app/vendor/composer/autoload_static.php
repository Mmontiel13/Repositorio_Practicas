<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9b63fbf09df100fb64fa5ec603368421
{
    public static $prefixLengthsPsr4 = array (
        'B' => 
        array (
            'BACKEND\\API\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'BACKEND\\API\\' => 
        array (
            0 => __DIR__ . '/../..' . '/backend/API',
        ),
    );

    public static $classMap = array (
        'BACKEND\\API\\Create\\Crear' => __DIR__ . '/../..' . '/backend/API/Create/Crear.php',
        'BACKEND\\API\\DataBase' => __DIR__ . '/../..' . '/backend/API/DataBase.php',
        'BACKEND\\API\\Delete\\Eliminar' => __DIR__ . '/../..' . '/backend/API/Delete/Eliminar.php',
        'BACKEND\\API\\Read\\Leer' => __DIR__ . '/../..' . '/backend/API/Read/Leer.php',
        'BACKEND\\API\\Update\\Actualizar' => __DIR__ . '/../..' . '/backend/API/Update/Actualizar.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9b63fbf09df100fb64fa5ec603368421::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9b63fbf09df100fb64fa5ec603368421::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9b63fbf09df100fb64fa5ec603368421::$classMap;

        }, null, ClassLoader::class);
    }
}