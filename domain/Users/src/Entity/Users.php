<?php

namespace Domain\Users\Entity;

use DateTime;
use DateTimeInterface;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema()
 */
class Users{

    /**
     * @OA\Property(type="string")
     * @var string
     */
    public string $nom ;
    /**
     * @OA\Property(type="string")
     * @var string
     */
    public string $email ;
    /**
     * @OA\Property(type="string")
     * @var string
     */
    public string $password;
    /**
     * @OA\Property(type="string")
     * @var string
     */
    public string $uuid;
    /**
     * @OA\Property(type="string", format="date-time")
     * @var \DateTimeInterface
     */
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