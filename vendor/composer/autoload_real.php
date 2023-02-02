<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit741f3026ff8b0de81f5565bd33ae9cbd
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit741f3026ff8b0de81f5565bd33ae9cbd', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit741f3026ff8b0de81f5565bd33ae9cbd', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit741f3026ff8b0de81f5565bd33ae9cbd::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
