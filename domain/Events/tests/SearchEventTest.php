<?php

use Domain\Events\Entity\Events;
use Domain\Events\Tests\Adapters\PdoEventsRepository;
use Domain\Events\UseCase\CreateEvent;
use Domain\Events\UseCase\SearchEvent;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertTrue;

test("Création  d'un évènement",function(){
    
    $repository = new PdoEventsRepository;
    $useCase = new CreateEvent($repository);
    $date = date('Y-m-d');
    $time = date('H:i');
    //dd($date);
    $event = $useCase->execute([
        'name' => 'Marathon tour 2023',
        'edate' => new DateTime($date),
        'etime' => new DateTime($time),
        'ville' => 'Bouaflé',
        'emplacement' => 'Place du marché',
        'prix' => 2000,
        'createdAt' => new DateTime(date('Y-m-d H:i:s'))
    ]);
    //dd($event,$repository->findOneEvent($event->uuid));
    assertInstanceOf(Events::class,$event);
    assertEquals($event,$repository->findOneEvent($event->uuid));

});

test("Recherche d'un évènement",function(){
    
    $repository = new PdoEventsRepository;

    $searchEvent = new SearchEvent($repository);
    $ville = 'Bouaflé';
    $edate = new DateTime('2023-04-23');

    $event = $searchEvent->execute([
        'ville' => $ville,
        'edate' => $edate
    ]);

    //dd($edate);
    //dd($user,$repository->connect($user->email,$user->password));
    assertInstanceOf(Events::class,$event);
    assertEquals($event,$repository->findSearchEvent($ville,$edate));

});