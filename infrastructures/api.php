<?php
require_once("../vendor/autoload.php");

$openapi = \OpenApi\Generator::scan([$_SERVER['DOCUMENT_ROOT'].'/domain']);

header('Content-Type: application/x-json');
echo $openapi->toJSON();
