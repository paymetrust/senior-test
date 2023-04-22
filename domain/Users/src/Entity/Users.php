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
        $date = date("Y-m-d H:i:s");
        $this->nom = $nom;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = new DateTime($date);
        $this->uuid = $uuid ?? uniqid();
        
    }



}