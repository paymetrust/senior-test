<?php
namespace Domain\Booking\UseCase;

use Assert\LazyAssertionException;
use DateTime;
use DateTimeInterface;
use Domain\Booking\Entity\Booking;
use Domain\Booking\Exception\InvalidBookingDataException;
use Domain\Booking\Port\IBookingRepository;
use Domain\Events\Tests\Adapters\PdoEventsRepository;
use Domain\Users\Tests\Adapters\PdoUsersRepository;

use function Assert\lazy;
use OpenApi\Annotations as OA;

//use Domain\Users\Tests\Adapters\InMemoryUsersRepository;

class CreateBooking{

   protected IBookingRepository $bookingRepository;

  public function __construct(IBookingRepository $repository)
  {
     $this->bookingRepository = $repository;
  }
/**
 * @OA\POST(
 *     path="/infrastructures/Api/Booking/createBooking.php",
 *    tags={"Réservation"},
 *     summary="La création d'une réservation",
 *     @OA\RequestBody(
 *       @OA\MediaType(
 *          mediaType="multipart/form-data",
 *          @OA\Schema(
 *            @OA\Property(
 *              property="user",
 *              type="string",
 *            ), 
 *            @OA\Property(
 *              property="event",
 *              type="string",
 *            ), 
 *            @OA\Property(
 *              property="nombreTicket",
 *              type="integer",
 *            ), 
 *            @OA\Property(
 *              property="fullName",
 *              type="string",
 *            ), 
 *            @OA\Property(
 *              property="email",
 *              type="string",
 *            ), 
 *       ),  
 *      ),
 *    ),
 *   @OA\Response(
 *          response="200",
 *        description="Création d'une réservation de ticket",
 *        @OA\JsonContent(ref="#/components/schemas/Booking"),
 *    )
 * )
 */
  public function execute(array $bookingData) :?Booking
  {
   //dd($bookingData);
   $userRepository = new PdoUsersRepository;
   $eventRepository = new PdoEventsRepository;
   //dd($bookingData);
   $destinataire= $bookingData['email'];
   $objet= "Confirmation de Réservation de ticket";
   $message=" <font face='arial'>
      Bonjour,
      Votre réservation de ticket a été prise en compte avec succès 
      </font>
   ";
   $entetes="From: test@paymetrust.net";
   $entetes.="Cc: admin@paymetrust.net";
   $entetes.="Content-Type: text/html; charset=iso-8859-1"; 

    $booking = new Booking(
      $bookingData['user'] ?? null,
      $bookingData['event'] ?? null,
      $bookingData['nombreTicket'] ?? '',
      $bookingData['fullName'] ?? '',
      $bookingData['email'] ?? '',
      $bookingData['createdAt'] ?? null
    );
    //dd($booking);
    try{
        $this->validate($booking);
        $this->bookingRepository->save($booking);
        mail($destinataire,$objet,$message,$entetes);
        return $booking;
    }catch(LazyAssertionException $e){
        throw new InvalidBookingDataException($e->getMessage());
    }
        
 }
 
    protected function validate(Booking $booking){
    lazy()->that($booking->nombreTicket)->notBlank()
          ->that($booking->fullName)->notBlank()->minLength(3)
          ->that($booking->email)->notBlank()
          ->that($booking->createdAt)->nullOr()->isInstanceOf(DateTimeInterface::class)
          ->verifyNow();
  }
}
