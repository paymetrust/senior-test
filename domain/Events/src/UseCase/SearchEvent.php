<?php
namespace Domain\Events\UseCase;

use Assert\LazyAssertionException;
use DateTimeInterface;
use Domain\Events\Entity\Events;
use Domain\Users\Exception\InvalidUserDataException;
use Domain\Events\Port\IEventsRepository;

use function Assert\lazy;
use OpenApi\Annotations as OA;
/**
 * @OA\Info(title="E-Ticket API", version="1.0")
 */


class SearchEvent{

   protected IEventsRepository $eventRepository;

  public function __construct(IEventsRepository $repository)
  {
     $this->eventRepository = $repository;
  }
  /*- in: query
  name: offset
  schema:
    type: integer
    default: 0
  description: The number of items to skip before starting to collect the result set
- in: query
  name: limit
  schema:
    type: integer
    default: 100
  description: The numbers of items to return
  */
/**
 * @OA\GET(
 *     path="/infrastructures/Api/Events/searchEvent.php?ville={ville}&date={edate}",
 *    tags={"Evenements"},
 *     summary="La création d'un évènement",
 *   @OA\Parameter(
 *       name="ville",
 *       description="La ville qui abrite l'évènement",
 *       required=true,
 *       in="query",
 *       @OA\Schema(
 *         type="string"
 *      )
 *    ),
 *   @OA\Response(
 *          response="200",
 *        description="Recherche d'un évèvement a partir de la ville et la date",
 *        @OA\JsonContent(ref="#/components/schemas/Events"),
 *    )
 * )
 */
  public function execute(array $eventData) :?Events
  {
        $ville = $eventData['ville'];
        $edate =$eventData['edate'];
        //->format('Y-m-d');
        $event = $this->eventRepository->findSearchEvent($ville,$edate);
        return $event;
        
 }
 
}
