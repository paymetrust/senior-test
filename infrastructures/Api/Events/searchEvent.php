<?php

use Domain\Events\Entity\Events;
use Domain\Events\Tests\Adapters\PdoEventsRepository;
use Domain\Events\UseCase\SearchEvent;

header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json;charset=UTF-8");
//dd($_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php");
require($_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php");


//use \DateTime;


//var_dump($_POST);

$repository = new PdoEventsRepository;
$useCase = new SearchEvent($repository);


  
/*$arrData = [

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
    'ville' => $_POST['ville'],
    'edate' => new DateTime($_POST['edate']),
];
$event = $repository->findSearchEvent($arrData['ville'],$arrData['edate']);
if($event){
    echo json_encode($event);
}else{
        echo json_encode(
        array(
            "type" => "danger",
            "titre" => "Enregistrement d'un évènement",
            "message" => "Veuillez rééssayer, échec de l'enregistrement"
        )
    );
}