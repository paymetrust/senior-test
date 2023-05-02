<?php
namespace Domain\Events\UseCase;

use Assert\LazyAssertionException;
use DateTimeInterface;
use Domain\Events\Entity\Events;
use Domain\Users\Exception\InvalidUserDataException;
use Domain\Events\Port\IEventsRepository;

use function Assert\lazy;
use OpenApi\Annotations as OA;

class SearchEvent{

   protected IEventsRepository $eventRepository;

  public function __construct(IEventsRepository $repository)
  {
     $this->eventRepository = $repository;
  }
/**
 * @OA\POST(
 *     path="/infrastructures/Api/Events/searchEvent.php",
 *    tags={"Evenements"},
 *     summary="La recherche d'un évènement",
 *     @OA\RequestBody(
 *       @OA\MediaType(
 *          mediaType="multipart/form-data",
 *          @OA\Schema(
 *            @OA\Property(
 *              property="ville",
 *              type="string",
 *              description="La ville à rechercher"
 * 
 *            ), 
 *            @OA\Property(
 *              property="edate",
 *              type="string",
 *              description="La date à rechercher"
 *            ),
 *       ),  
 *      ),
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
