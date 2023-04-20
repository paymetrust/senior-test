<?php

namespace Domain\Users\Tests\Adapters;

use Domain\Users\Entity\Users;
use Domain\Users\Port\IUsersRepository;

class InMemoryUsersRepository implements IUsersRepository{

   public array $users = [];

   public function save(Users $user)
   {
    $this->users[$user->uuid] = $user;
   }

   public function findOne(string $uuid) : ?Users{
     return $this->users[$uuid] ?? null;

   }
}