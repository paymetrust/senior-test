<?php
namespace Domain\Events\UseCase;

use Assert\LazyAssertionException;
use DateTimeInterface;
use Domain\Events\Entity\Events;
use Domain\Users\Exception\InvalidUserDataException;
use Domain\Events\Port\IEventsRepository;

use function Assert\lazy;

//use Domain\Users\Tests\Adapters\InMemoryUsersRepository;

class SearchEvent{

   protected IEventsRepository $eventRepository;

  public function __construct(IEventsRepository $repository)
  {
     $this->eventRepository = $repository;
  }

  public function execute(array $eventData) :?Events
  {
        $ville = $eventData['ville'];
        $edate =$eventData['edate'];
        //->format('Y-m-d');
        $event = $this->eventRepository->findSearchEvent($ville,$edate);
        return $event;
        
 }
 
}
