<?php
namespace Domain\Booking\UseCase;

use Assert\LazyAssertionException;
use DateTimeInterface;
use Domain\Booking\Entity\Booking;
use Domain\Booking\Exception\InvalidBookingDataException;
use Domain\Booking\Port\IBookingRepository;
use Domain\Booking\Tests\Adapters\PdoBookingRepository;

use function Assert\lazy;
use OpenApi\Annotations as OA;

//use Domain\Users\Tests\Adapters\InMemoryUsersRepository;

class ConfirmBooking{

   protected IBookingRepository $bookingRepository;

  public function __construct(IBookingRepository $repository)
  {
     $this->bookingRepository = $repository;
  }
/**
 * @OA\POST(
 *     path="/infrastructures/Api/Booking/confirmBooking.php",
 *    tags={"Réservation"},
 *     summary="La Confirmation d'une réservation",
 *     @OA\RequestBody(
 *       @OA\MediaType(
 *          mediaType="multipart/form-data",
 *          @OA\Schema(
 *            @OA\Property(
 *              property="uuid",
 *              type="string",
 *              description="la référence de la réservation",
 *            ),
 *       ),  
 *      ),
 *    ),
 *   @OA\Response(
 *          response="200",
 *        description="Confirmation d'une réservation",
 *        @OA\JsonContent(ref="#/components/schemas/Booking"),
 *    )
 * )
 */
  public function execute(array $bookingData) :?Booking
  {
       
        $bookingRepository = new PdoBookingRepository;

        $booking = $bookingRepository->findOneBooking($bookingData['uuid']);
       

        $bookingConfirm = $this->bookingRepository->ConfirmBooking($booking);
       //dd($booking,$bookingConfirm);
        return $booking;
        
 }
 
}
