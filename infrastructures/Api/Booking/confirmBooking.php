<?php

use Domain\Booking\Tests\Adapters\PdoBookingRepository;
use Domain\Booking\UseCase\ConfirmBooking;
use Domain\Booking\UseCase\CreateBooking;


header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json;charset=UTF-8");
//dd($_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php");
require($_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php");

//use \DateTime;


//var_dump($_POST);

$repository = new PdoBookingRepository;

$useCase = new ConfirmBooking($repository);

// $bookingUuid = '6445c2e7ab346';  
// $bookingUuid = '6445c2e7ab346';  

$booking = $repository->findOneBooking($_POST['uuid']);
//dd($booking);

$arrData = [
    'uuid' => $_POST['uuid'],
];
$bookingConfirm = $useCase->execute($arrData);


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

if($bookingConfirm){
    echo json_encode(
        array(
            "type" => "succes",
            "titre" => "Confirmation de reservation",
            "message" => "Votre confirmation a bien été prise en compte"
        )
    );
}else{
        echo json_encode(
        array(
            "type" => "danger",
            "titre" => "Confirmation de reservation",
            "message" => "Veuillez rééssayer, échec de la confirmation!"
        )
    );
}