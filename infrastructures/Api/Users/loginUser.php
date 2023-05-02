<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json;charset=UTF-8");
//dd($_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php");
require($_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php");

use Domain\Users\Tests\Adapters\PdoUsersRepository;
use Domain\Users\UseCase\LoginUser;

$repository = new PdoUsersRepository;
$loginUser = new LoginUser($repository);
/*
$login = 'test@paymetrust.net';
$mdp = 'Pass@123';

$arrData = [
    'email' => $login,
    'password' => $mdp
];


var_dump($_POST);

*/
$arrData = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
];
/*var_dump($arrData);

die();

*/
$user = $loginUser->execute($arrData);
if($user){
 echo json_encode($user);   
}else{
  echo json_encode([
    "type"=>"danger",
    "title"=>"Connection de l'utilisateur",
    "message"=>"Aucune données trouvées"
  ]);
}
