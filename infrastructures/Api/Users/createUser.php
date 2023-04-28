<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json;charset=UTF-8");
//dd($_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php");
require($_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php");

use Domain\Users\Tests\Adapters\PdoUsersRepository;
use Domain\Users\UseCase\CreateUser;
//use \DateTime;


//var_dump($_POST);

$repository = new PdoUsersRepository;
$useCase = new CreateUser($repository);

$date = date('Y-m-d H:i:s');
$arrData = [
    'nom' => $_POST['nom'],
    'email' => $_POST['email'],
    'password' => md5($_POST['password']),
    'createdAt' => new DateTime($date)
];
/*
var_dump($arrData);

die();
$arrData = [
    'nom' => 'Eric Zou',
    'email' => 'amanieric@paymetrust.net',
    'password' => md5('Pass@123'),
    'createdAt' => new DateTime($date)
];
*/
$user = $useCase->execute($arrData);

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