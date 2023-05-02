<?php

use Domain\Booking\Entity\Booking;
use Domain\Booking\Tests\Adapters\PdoBookingRepository;
use Domain\Booking\UseCase\CreateBooking;
use Domain\Events\Entity\Events;
use Domain\Events\Tests\Adapters\PdoEventsRepository;
use Domain\Users\Entity\Users;
use Domain\Users\Tests\Adapters\PdoUsersRepository;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertTrue;

test("Reservation d'un ticket ",function(){
    $repository = new PdoBookingRepository;
    $userRepository = new PdoUsersRepository;
    $eventRepository = new PdoEventsRepository;

    $useCase = new CreateBooking($repository);
    
    $userUuid = '644588105e59a';
    $eventUuid = '64457268bd1bd';
    
    $user = $userRepository->findOne($userUuid);
    $event = $eventRepository->findOneEvent($eventUuid);
    //dd($user);
    //dd($event);
    //dd($user->uuid,$event->uuid);
    $booking = $useCase->execute([
        'user' =>$user,
        'event' => $event,
         'nombreTicket' => 2,
        'fullName' => 'Paymetrust fullname',
        'email' => 'test@paymetrust.net',
        'createdAt' => new DateTime(date('Y-m-d H:i:s'))
    ]);
    //dd($booking,$repository->findOneBooking($event->uuid));
    assertInstanceOf(Booking::class,$booking);
    assertEquals($booking,$repository->findOneBooking($booking->uuid));
    
});