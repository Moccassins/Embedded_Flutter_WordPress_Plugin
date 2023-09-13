<?php

namespace CodeCracker;

// class to static store plugin's metadata
class PluginConfig
{
    private static $config = [
        'author' => 'Default Author',
        'name' => 'Default Name',
        'id' => 'default_id',
        'uri' => 'https://yourpage.com',
    ];

    public static function get($key)
    {
        return self::$config[$key] ?? null;
    }

    public static function set($key, $value)
    {
        self::$config[$key] = $value;
    }
}
