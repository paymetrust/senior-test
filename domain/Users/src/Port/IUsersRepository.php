<?php

namespace  Domain\Users\Port;

use Domain\Users\Entity\Users;

interface IUsersRepository{

    public function save(Users $user);
    public function connect(string $email,string $password): ?Users;
    public function findOne(string $uuid): ?Users;


}