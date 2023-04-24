<?php
namespace Domain\Booking\Entity;

use DateTime;
use DateTimeInterface;
use Domain\Events\Entity\Events;
use Domain\Users\Entity\Users;

class Booking{

    public Users $user ;
    public Events $event ;
    public int $nombreTicket;
    public string $fullName;
    public string $email;
    public bool $confirmation=false;
    public string $uuid;
    public DateTimeInterface $createdAt;

    public function __construct(Users $user,
                                Events $event,
                                int $nombreTicket,
                                string $fullName,
                                string $email,
                                ?DateTimeInterface $createdAt,
                                ?string $uuid=null)
    {
        $this->user = $user;
        $this->event = $event;
        $this->nombreTicket = $nombreTicket;
        $this->fullName = $fullName;
        $this->email = $email;
        $this->createdAt = $createdAt;
        $this->uuid = $uuid ?? uniqid();
        
    }
}