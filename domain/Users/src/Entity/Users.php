<?php

namespace Domain\Users\Entity;

use DateTime;
use DateTimeInterface;

class Users{

    public string $nom ;
    public string $email ;
    public string $password;
    public string $uuid;
    public DateTimeInterface $createdAt;

    public function __construct(string $nom,string $email,string $password,?DateTimeInterface $createdAt,?string $uuid=null)
    {
        $this->nom = $nom;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = $createdAt;
        $this->uuid = $uuid ?? uniqid();
        
    }



}