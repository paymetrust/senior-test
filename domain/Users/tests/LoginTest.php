<?php

use Domain\Users\Entity\Users;
use Domain\Users\Exception\InvalidUserDataException;
use Domain\Users\Tests\Adapters\InMemoryUsersRepository;
use Domain\Users\Tests\Adapters\PdoUsersRepository;
use Domain\Users\UseCase\CreateUser;
use Domain\Users\UseCase\LoginUser;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertInstanceOf;


test("Connection à l'interface par le User",function(){
    $repository = new PdoUsersRepository;

    $loginUser = new LoginUser($repository);
    $login = 'test@paymetrust.net';
    $mdp = 'Pass@123';

    $user = $loginUser->execute([
        'email' => $login,
        'password' => $mdp
    ]);
    //dd($user,$repository->connect($user->email,$user->password));
    assertInstanceOf(Users::class,$user);
    assertEquals($user,$repository->connect($login,$mdp));

});