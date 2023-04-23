<?php
namespace Domain\Events\UseCase;

use Assert\LazyAssertionException;
use DateTime;
use DateTimeInterface;
use Domain\Events\Entity\Events;
use Domain\Events\Exception\InvalidEventDataException;
use Domain\Events\Port\IEventsRepository;

use function Assert\lazy;

//use Domain\Users\Tests\Adapters\InMemoryUsersRepository;

class CreateEvent{

   protected IEventsRepository $eventRepository;

  public function __construct(IEventsRepository $repository)
  {
     $this->eventRepository = $repository;
  }

  public function execute(array $eventData) :?Events
  {
    $event = new Events(
      $eventData['name'] ?? '',
      $eventData['edate'] ?? '',
      $eventData['etime'] ?? '',
      $eventData['ville'] ?? '',
      $eventData['emplacement'] ?? '',
      $eventData['prix'] ?? '',
      $eventData['createdAt'] ?? null
    );
    //dd($user);
    try{
        $this->validate($event);
        $this->eventRepository->save($event);
        return $event;
    }catch(LazyAssertionException $e){
        throw new InvalidEventDataException($e->getMessage());
    }
        
 }
 
    protected function validate(Events $event){
    lazy()->that($event->name)->notBlank()->minLength(3)
          ->that($event->edate)->notBlank()
          ->that($event->etime)->notBlank()
          ->that($event->ville)->notBlank()
          ->that($event->emplacement)->notBlank()
          ->that($event->prix)->notBlank()
          ->that($event->createdAt)->nullOr()->isInstanceOf(DateTimeInterface::class)
          ->verifyNow();
  }
}
