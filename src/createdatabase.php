<?php

require __DIR__ . '/Entities/DataBase.php';
require __DIR__ . '/Entities/Config.php';

use Nimarya\Simple\Entities\Config;
use Nimarya\Simple\Entities\DataBase;

$config = Config::make();
$database = new DataBase($config->dsn, $config->login, $config->password);
