<?php

namespace  Domain\Events\Port;

use DateTimeInterface;
use Domain\Events\Entity\Events;

interface IEventsRepository{

    public function save(Events $events);
    public function findOneEvent(string $uuid): ?Events;
    public function findSearchEvent(string $ville, DateTimeInterface $date): ?Events;


}