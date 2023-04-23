<?php
namespace Domain\Events\Entity;

use DateTime;
use DateTimeInterface;

class Events{

    public string $name ;
    public DateTimeInterface $edate ;
    public DateTimeInterface $etime;
    public string $emplacement;
    public string $ville;
    public float $prix;
    public string $uuid;
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