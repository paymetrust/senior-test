<?php
namespace Domain\Users\UseCase;

use Assert\LazyAssertionException;
use DateTimeInterface;
use Domain\Users\Entity\Users;
use Domain\Users\Exception\InvalidUserDataException;
use Domain\Users\Port\IUsersRepository;

use function Assert\lazy;

//use Domain\Users\Tests\Adapters\InMemoryUsersRepository;

class LoginUser{

   protected IUsersRepository $userRepository;

  public function __construct(IUsersRepository $repository)
  {
     $this->userRepository = $repository;
  }

  public function execute(array $userData) :?Users
  {
        $email = $userData['email'];
        $password = $userData['password'];
        $user = $this->userRepository->connect($email,$password);
        //dd($user);
        return $user;
        
 }
 
}
