<?php
namespace Domain\Events\Entity;

use DateTime;
use DateTimeInterface;
use OpenApi\Annotations as OA;
/**
 * @OA\Schema()
 */
class Events{
    /**
     * @OA\Property(type="string")
     * @var string
     */
    public string $name ;
    /**
     * @OA\Property(type="string", format="date-time")
     * @var \DateTimeInterface
     */
    public DateTimeInterface $edate ;
    /**
     * @OA\Property(type="string", format="date-time")
     * @var \DateTimeInterface
     */
    public DateTimeInterface $etime;
    /**
     * @OA\Property(type="string")
     * @var string
     */
    public string $emplacement;
    /**
     * @OA\Property(type="string")
     * @var string
     */
    public string $ville;
    /**
     * @OA\Property(type="float")
     * @var float
     */
    public float $prix;
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

    public function __construct(string $name,
                                DateTimeInterface $edate,
                                DateTimeInterface $etime,
                                string $ville,
                                string $emplacement,
                                float $prix,
                                ?DateTimeInterface $createdAt,
                                ?string $uuid=null)
    {
        $this->name = $name;
        $this->edate = $edate;
        $this->etime = $etime;
        $this->ville = $ville;
        $this->emplacement = $emplacement;
        $this->prix = $prix;
        $this->createdAt = $createdAt;
        $this->uuid = $uuid ?? uniqid();
        
    }
}