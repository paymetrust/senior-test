<?php
namespace Domain\Booking\Entity;

use DateTime;
use DateTimeInterface;
use Domain\Events\Entity\Events;
use Domain\Users\Entity\Users;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema()
 */
class Booking{

    /**
     * @OA\Property(type="string")
     * @var objet
     */
    public Users $user ;
    /**
     * @OA\Property(type="string")
     * @var objet
     */
    public Events $event ;
    /**
     * @OA\Property(type="integer")
     * @var int
     */
    public int $nombreTicket;
    /**
     * @OA\Property(type="string")
     * @var string
     */
    public string $fullName;
    /**
     * @OA\Property(type="string")
     * @var string
     */
    public string $email;
    /**
     * @OA\Property(type="integer")
     * @var int
     */
    public bool $confirmation=false;
    /**
     * @OA\Property(type="string")
     * @var string
     */
    public string $uuid;
    /**
     * @OA\Property(type="string",format="date-time")
     * @var \DateTimeInterface
     */
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