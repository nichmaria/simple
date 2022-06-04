<?php

namespace Entities;

class Config
{
    public static Config|null $config = null;
    public string $dsn;
    public string $login;
    public string $password;

    private function __construct()
    {
    }

    public static function make(): Config
    {
        if (Config::$config == null) {
            Config::$config = new Config;
            $info = include __DIR__ . '/../config.php';
            Config::$config->dsn = 'mysql:host=' . $info['host'] . ';dbname=' . $info['dbname'];
            Config::$config->login = $info['login'];
            Config::$config->password = $info['password'];
        }

        return Config::$config;
    }
}
