<?php
namespace Domain\Users\Tests\Adapters;

use Domain\Users\Entity\Users;
use Domain\Users\Port\IUsersRepository;
use PDO;

class PdoUsersRepository implements IUsersRepository{

    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=PostgreSQLdb;charset=utf8;','quitus','admin',[
            PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
        ]);
        
    }

    public function save(Users $user)
    {
        $query = $this->pdo->prepare('
        INSERT INTO users SET
        nom = :nom,
        email = :email,
        password = :password,
        createdAt = :createdAt,
        uuid = :uuid
        ');

        $query->execute(
                        ['nom' => $user->nom,
                         'email' => $user->email,
                         'password' => $user->password, 
                         'createdAt' => $user->createdAt ? $user->createdAt:null,
                         'uuid' => $user->uuid]

        );
    }

    public function findOne(string $uuid): ?Users
    {
        $query = $this->('
        SELECT u.* FROM users u
        ')
    }


}