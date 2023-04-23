<?php
namespace Domain\Users\Tests\Adapters;

use DateTime;
use Domain\Users\Entity\Users;
use Domain\Users\Port\IUsersRepository;
use PDO;

class PdoUsersRepository implements IUsersRepository{

    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=PostgreSQLdb;charset=utf8;','quitus','admin',[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        
    }

    public function save(Users $user)
    {
        //dd($user);
        $sql ='INSERT INTO users SET nom = :nom, email = :email, password = :password, createdAt = :createdAt,uuid = :uuid';
        $query = $this->pdo->prepare($sql);

        $query->execute([
                          'nom' => $user->nom,
                          'email' => $user->email,
                          'password' => $user->password,
                          'createdAt' =>$user->createdAt? $user->createdAt->format('Y-m-d H:i:s'):null,
                          'uuid' => $user->uuid,
                          
                          ]);
    }

    public function connect(string $email, string $password): ?Users
    {
        $sql ='SELECT u.*  FROM users u WHERE u.email = :email AND password = :password LIMIT 0,1';
        $query = $this->pdo->prepare($sql);

        $query->execute([
            'email' => $email,
            'password' => Md5($password),
        ]);

        $result = $query->fetch(PDO::FETCH_ASSOC);

        if(!$result){
           return null;
        }
        //dd($result);
        //dd($result['createdAt']);
        //$date = date('Y-m-d H:i:s');
        $user = new Users($result['nom'],
                          $result['email'],
                          $result['password'],
                          $result['createdAt']? new DateTime($result['createdAt']):null,
                          $result['uuid']);

        return $user;
    }
   
    public function findOne(string $uuid): ?Users
    {
        $sql ='SELECT u.*  FROM users u WHERE u.uuid = :uuid';
        $query = $this->pdo->prepare($sql);

        $query->execute([
            'uuid' => $uuid
        ]);

        $result = $query->fetch(PDO::FETCH_ASSOC);

        if(!$result){
           return null;
        }
        //dd($result);
        //$date = date('Y-m-d H:i:s');
        $user = new Users($result['nom'],
                          $result['email'],
                          $result['password'],
                          $result['createdAt']? new DateTime($result['createdAt']):null,
                          $result['uuid']);

        return $user ;
    }


}