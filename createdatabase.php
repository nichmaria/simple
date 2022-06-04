<?php

require __DIR__ . '/Entities/DataBase.php';
require __DIR__ . '/Entities/Config.php';

use Entities\Config;
use Entities\DataBase;

$config = Config::make();
$database = new DataBase($config->dsn, $config->login, $config->password);
