<?php
require_once("../vendor/autoload.php");

$openapi = \OpenApi\Generator::scan([$_SERVER['DOCUMENT_ROOT'].'/senior-test/domain/Users/src/Entity']);

header('Content-Type: application/x-json');
echo $openapi->toJSON();
