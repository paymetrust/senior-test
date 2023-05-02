<?php

namespace  Domain\Booking\Port;

use DateTimeInterface;
use Domain\Booking\Entity\Booking;

interface IBookingRepository{

    public function save(Booking $booking);
    public function confirmBooking(Booking $booking);
    public function findOneBooking(string $uuid): ?Booking;

}