<?php

use Infrastructures\Pdo\DataBase;

require_once('vendor/autoload.php');

$db = new DataBase;

$db->getConnexion();
