<?php

namespace Domain\Events\Tests\Adapters;

use DateTimeInterface;
use Domain\Events\Entity\Events;
use Domain\Events\Port\IEventsRepository;

class InMemoryEventsReporitory implements IEventsRepository{

   public array $events = [];

   public function save(Events $event)
   {
    $this->events[$event->uuid] = $event;
   }

   public function findOneEvent(string $uuid) : ?Events{
     return $this->events[$uuid] ?? null;

   }
   public function findSearchEvent(string $ville,DateTimeInterface $date) : ?Events{
     return $this->events[$ville] ?? null;

   }
 
}