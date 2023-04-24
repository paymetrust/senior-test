<?php

use Domain\Booking\Tests\Adapters\PdoBookingRepository;
use Domain\Booking\UseCase\ConfirmBooking;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertTrue;

test("Confirmation de reservation de ticket ",function(){
    $repository = new PdoBookingRepository;
    $useCase = new ConfirmBooking($repository);
    
    $bookingUuid = '6445c2e7ab346';  
    
    $booking = $repository->findOneBooking($bookingUuid);
    //dd($booking);

    $bookingConfirm = $useCase->execute([
        'uuid' => $bookingUuid,
    ]);
    //dd($booking);
    //dd($booking,$repository->findOneBooking($event->uuid));
    //assertInstanceOf(Booking::class,$booking);
    assertEquals($booking,$repository->findOneBooking($booking->uuid));
});