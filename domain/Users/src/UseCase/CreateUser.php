<?php
namespace Domain\Users\UseCase;
use Assert\LazyAssertionException;
use DateTimeInterface;
use Domain\Users\Entity\Users;
use Domain\Users\Exception\InvalidUserDataException;
use Domain\Users\Port\IUsersRepository;
use function Assert\lazy;
use OpenApi\Annotations as OA;
/**
 * @OA\Info(title="API E-Ticket", version="1.0.0",
 *       contact="07 89 91 91 99"),
 * @OA\Server(url="http://api-e-ticke.ci",description="L'url du serveur ...r"),
 */
class CreateUser{

   protected IUsersRepository $userRepository;

  public function __construct(IUsersRepository $repository)
  {
     $this->userRepository = $repository;
  }
/**
 * @OA\POST(
 *     path="/infrastructures/Api/Users/createUser.php",
 *     tags={"Utilisateurs"},
 *     summary="La création d'un utilisateur",
 *     @OA\RequestBody(
 *       @OA\MediaType(
 *          mediaType="multipart/form-data",
 *          @OA\Schema(
 *            @OA\Property(
 *              property="nom",
 *              type="string",
 *              description="le nom de l'utilisateur"
 *            ), 
 *            @OA\Property(
 *              property="email",
 *              type="string",
 *              description="le mail de l'utilisateur"
 *            ), 
 *            @OA\Property(
 *              property="password",
 *              type="string",
 *              description="le not de placce "
 *            ), 
 *       ),  
 *      ),
 *    ),
 *   @OA\Response(
 *          response="200",
 *        description="Création d'un utilisateur avec succès",
 *        @OA\JsonContent(ref="#/components/schemas/Users"),
 *    )
 *     ),
 *   @OA\Response(
 *        response="404",
 *        description="Echec de la creation d'un utilisateur"
 *    )
 * )
 */
  public function execute(array $userData) :?Users
  {
    $user = new Users(
      $userData['nom'] ?? '',
      $userData['email'] ?? '',
      $userData['password'] ?? '',
      $userData['createdAt'] ?? null
    );
    //dd($user);
    try{
        $this->validate($user);
        $this->userRepository->save($user);
        return $user;
    }catch(LazyAssertionException $e){
        throw new InvalidUserDataException($e->getMessage());
    }
        
 }
 
    protected function validate(Users $user){
    lazy()->that($user->nom)->notBlank()->minLength(3)
          ->that($user->email)->notBlank()
          ->that($user->createdAt)->nullOr()->isInstanceOf(DateTimeInterface::class)
          ->verifyNow();
  }
}
