<?php

use Domain\Users\Entity\Users;
use Domain\Users\Tests\Adapters\InMemoryUsersRepository;
use Domain\Users\Tests\Adapters\PdoUsersRepository;
use Domain\Users\UseCase\CreateUser;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertInstanceOf;

it("should register a User",function(){

    $repository = new PdoUsersRepository;
    $useCase = new CreateUser($repository);
    $date = date('Y-m-d H:i:s');
    //dd($date);
    $user = $useCase->execute([
        'nom' => 'mon nom',
        'email' => 'test@paymetrust.net',
        'password' => md5('Pass@123'),
        'createdAt' => new DateTime($date)
    ]);
    assertInstanceOf(Users::class,$user);
    assertEquals($user,$repository->findOne($user->uuid));

});