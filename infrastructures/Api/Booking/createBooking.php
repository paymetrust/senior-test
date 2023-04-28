<?php

use Domain\Booking\Tests\Adapters\PdoBookingRepository;
use Domain\Booking\UseCase\CreateBooking;
use Domain\Events\Tests\Adapters\PdoEventsRepository;
use Domain\Users\Tests\Adapters\PdoUsersRepository;

header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json;charset=UTF-8");
//dd($_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php");
require($_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php");

//use \DateTime;


//var_dump($_POST);

$repository = new PdoBookingRepository;
$useCase = new CreateBooking($repository);

$userRepository = new PdoUsersRepository;
$eventRepository = new PdoEventsRepository;


$userUuid = $_POST['user'];
$eventUuid = $_POST['event'];

$user = $userRepository->findOne($userUuid);
$event = $eventRepository->findOneEvent($eventUuid);
$date = date('Y-m-d H:i:s');
$arrData = [
        'user' =>$user,
        'event' => $event,
         'nombreTicket' => $_POST['nombreTicket'],
        'fullName' => $_POST['fullName'],
        'email' => $_POST['email'],
        'createdAt' => new DateTime(date('Y-m-d H:i:s'))
    ];


/*

    $userUuid = '644588105e59a';
    $eventUuid = '64457268bd1bd';

var_dump($arrData);

die();
$arrData = [
    'nom' => 'Eric Zou',
    'email' => 'amanieric@paymetrust.net',
    'password' => md5('Pass@123'),
    'createdAt' => new DateTime($date)
];

 $useCase->execute();
*/
$booking = $useCase->execute($arrData);

if($user){
    echo json_encode(
        array(
            "type" => "succes",
            "titre" => "Enregistrement d'un utilisateur",
            "message" => "Utilisateur enregistré avec succès"
        )
    );
}else{
        echo json_encode(
        array(
            "type" => "danger",
            "titre" => "Enregistrement d'un utilisateur",
            "message" => "Veuillez rééssayer, échec de l'enregistrement!"
        )
    );
}