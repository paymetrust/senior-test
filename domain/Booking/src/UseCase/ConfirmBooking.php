<?php
namespace Domain\Booking\UseCase;

use Assert\LazyAssertionException;
use DateTimeInterface;
use Domain\Booking\Entity\Booking;
use Domain\Booking\Exception\InvalidBookingDataException;
use Domain\Booking\Port\IBookingRepository;
use Domain\Booking\Tests\Adapters\PdoBookingRepository;

use function Assert\lazy;

//use Domain\Users\Tests\Adapters\InMemoryUsersRepository;

class ConfirmBooking{

   protected IBookingRepository $bookingRepository;

  public function __construct(IBookingRepository $repository)
  {
     $this->bookingRepository = $repository;
  }

  public function execute(array $bookingData) :?Booking
  {
       
        $bookingRepository = new PdoBookingRepository;

        $booking = $bookingRepository->findOneBooking($bookingData['uuid']);
       

        $bookingConfirm = $this->bookingRepository->ConfirmBooking($booking);
       //dd($booking,$bookingConfirm);
        return $booking;
        
 }
 
}
