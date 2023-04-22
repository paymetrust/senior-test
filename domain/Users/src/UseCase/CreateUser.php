<?php
namespace Domain\Users\UseCase;

use Assert\LazyAssertionException;
use DateTimeInterface;
use Domain\Users\Entity\Users;
use Domain\Users\Exception\InvalidUserDataException;
use Domain\Users\Port\IUsersRepository;

use function Assert\lazy;

//use Domain\Users\Tests\Adapters\InMemoryUsersRepository;

class CreateUser{

   protected IUsersRepository $userRepository;

   public function __construct(IUsersRepository $repository)
   {
     $this->userRepository = $repository;
   }

    public function execute(array $userData) :?Users{
        $user = new Users(
          $userData['nom'] ?? '',
          $userData['email'] ?? '',
          $userData['password'] ?? '',
          $userData['createdAt'] ?? null
        );
        //dd($user);
       try{
           $this->validate($user);
           $this->userRepository->save($user);
           return $user;
       }catch(LazyAssertionException $e){
           throw new InvalidUserDataException($e->getMessage());
       }
        
    }
  protected function validate(Users $user){
    lazy()->that($user->nom)->notBlank()->minLength(3)
          ->that($user->email)->notBlank()
          ->that($user->createdAt)->nullOr()->isInstanceOf(DateTimeInterface::class)
          ->verifyNow();
  }
}
