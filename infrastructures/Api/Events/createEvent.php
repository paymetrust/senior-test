<?php

use Domain\Events\Entity\Events;
use Domain\Events\Tests\Adapters\PdoEventsRepository;
use Domain\Events\UseCase\CreateEvent;

header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json;charset=UTF-8");
//dd($_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php");
require($_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php");


//use \DateTime;


//var_dump($_POST);

$repository = new PdoEventsRepository;
$useCase = new CreateEvent($repository);


/*
var_dump($_POST);

die();    
$arrData = [

    'name' => 'Femua tour 2023',
    'edate' => new DateTime($date),
    'etime' => new DateTime($time),
    'ville' => 'Bouaflé',
    'emplacement' => 'Place du marché',
    'prix' => 2000,
    'createdAt' => new DateTime(date('Y-m-d H:i:s'))
];
*/
$date = date('Y-m-d');
$time = date('H:i');
$arrData = [
    'name' => $_POST['name'],
    'edate' => new DateTime($_POST['edate']),
    'etime' => new DateTime($_POST['etime']),
    'ville' => $_POST['ville'],
    'emplacement' => $_POST['emplacement'],
    'prix' => $_POST['prix'],
    'createdAt' => new DateTime(date('Y-m-d H:i:s'))
];
$event = $useCase->execute($arrData);
if($event){
    echo json_encode(
        array(
            "type" => "succes",
            "titre" => "Enregistrement d'un évènement",
            "message" => "évènement enregistré avec succès"
        )
    );
}else{
        echo json_encode(
        array(
            "type" => "danger",
            "titre" => "Enregistrement d'un évènement",
            "message" => "Veuillez rééssayer, échec de l'enregistrement"
        )
    );
}