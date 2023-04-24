<?php
namespace Domain\Booking\Tests\Adapters;

use DateTime;
use DateTimeInterface;
use Domain\Booking\Entity\Events;
use Domain\Booking\Entity\Booking;
use Domain\Booking\Port\IBookingRepository;
use Domain\Events\Tests\Adapters\PdoEventsRepository;
use Domain\Users\Tests\Adapters\PdoUsersRepository;
use PDO;
use PHPUnit\Framework\Constraint\IsInstanceOf;

class PdoBookingRepository implements IBookingRepository{

    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=PostgreSQLdb;charset=utf8;','quitus','admin',[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        
    }

    public function save(Booking $booking)
    {
        //dd($booking);
        $sql ='INSERT INTO booking SET user = :user, 
                                      event = :event, 
                                      nombreTicket = :nombreTicket, 
                                      fullName = :fullName, 
                                      email = :email, 
                                      confirmation = :confirmation, 
                                      createdAt = :createdAt,
                                      uuid = :uuid';
        $query = $this->pdo->prepare($sql);

        $query->execute([
                          'user' => $booking->user->uuid,
                          'event' => $booking->event->uuid,
                          'nombreTicket' => $booking->nombreTicket,
                          'fullName' => $booking->fullName,
                          'email' => $booking->email,
                          'confirmation' => 0,
                          'createdAt' =>$booking->createdAt? $booking->createdAt->format('Y-m-d H:i:s'):null,
                          'uuid' => $booking->uuid,
                          
                          ]);
        //envoie de email après enregistrement de la reservation
    }

    public function confirmBooking(Booking $booking)
    {
        $sql ='UPDATE booking SET  confirmation = 1 WHERE uuid = :uuid';
        //dd($uuid);
        $query = $this->pdo->prepare($sql);

        $query->execute([
            'uuid' => $booking->uuid
        ]);
        //Retour et confirmation de la commande par email
       
    }
   
     public function findOneBooking(string $uuid): ?Booking
    {
        $sql ='SELECT b.*  FROM booking b WHERE b.uuid = :uuid LIMIT 0,1';
        $query = $this->pdo->prepare($sql);

        $query->execute([
            'uuid' => $uuid
        ]);

        $result = $query->fetch(PDO::FETCH_ASSOC);

        if(!$result){
           return null;
        }
        //dd($result);
       // dd($result['createdAt']);
        //$date = date('Y-m-d H:i:s');
        $userRepository = new PdoUsersRepository;
        $eventRepository = new PdoEventsRepository;
        $user = $userRepository->findOne($result['user']);
        $event = $eventRepository->findOneEvent($result['event']);

        $booking = new Booking($user,
                          $event,
                          $result['nombreTicket'],
                          $result['fullName'],
                          $result['email'],
                         // $result['confirmation'],
                          $result['createdAt']? new DateTime($result['createdAt']):null,
                          $result['uuid']);
                          

        return $booking;
    }
   

    
   
}