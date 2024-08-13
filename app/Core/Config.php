<?php

namespace App\Core;

use Exception;

class Config
{

    private static array  $config    = [];
    private static string $configDir = "../config";

    public static function init(): void
    {
        static::readConfigFromDir();
    }

    private static function readConfigFromDir(): void
    {
        // Check is dir /config
        if (is_dir(self::$configDir)) {

            // Open Dir 
            if ($dh = opendir(self::$configDir)) {

                // Read dir and set to config
                while (($file = readdir($dh)) !== false) {
                    if ($file !== "." && $file !== "..") {
                        static::addConfig($file);
                    }
                }

                // Close Dir
                closedir($dh);
            }
        }
    }

    private static function addConfig($file): void
    {
        static::$config[explode(".", $file)[0]] = require static::$configDir . '/' . $file;
    }

    public static function getConfig($string)
    {
        $segments = explode(".", $string);
        $firstKey = $segments[0];

        $config   = self::$config[$firstKey] ?? [];

        if( count($segments) === 0 ){
            return $config;
        }

        unset($segments[0]);

        foreach( $segments as $segment ){
            if ( isset($config[$segment]) ){
                $config = $config[$segment];
            } 
        }

        return $config;
    }

    public static function getAll(): array
    {
        return static::$config;
    }
}
