<?php

namespace Domain\Booking\Tests\Adapters;

use DateTimeInterface;
use Domain\Booking\Entity\Booking;
use Domain\Booking\Entity\Events;
use Domain\Booking\Port\IBookingRepository;

class InMemoryBookingReporitory implements IBookingRepository{

   public array $booking = [];

   public function save(Booking $booking)
   {
    $this->booking[$booking->uuid] = $booking;
   }
   
   public function confirmBooking(Booking $booking)
   {
     $this->booking[$booking->uuid] = $booking;
   }

   public function findOneBooking(string $uuid): ?Booking
   {
    return $this->booking[$uuid] ?? null;
   }
 
}