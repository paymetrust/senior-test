<?php
namespace Domain\Users\UseCase;

use Assert\LazyAssertionException;
use DateTimeInterface;
use Domain\Users\Entity\Users;
use Domain\Users\Exception\InvalidUserDataException;
use Domain\Users\Port\IUsersRepository;

use function Assert\lazy;
use OpenApi\Annotations as OA;

//use Domain\Users\Tests\Adapters\InMemoryUsersRepository;

class LoginUser{

   protected IUsersRepository $userRepository;

  public function __construct(IUsersRepository $repository)
  {
     $this->userRepository = $repository;
  }

/**
 * @OA\POST(
 *     path="/infrastructures/Api/Users/loginUser.php",
 *     summary="se connecter avec l'email et mot de passe",
 *     tags={"Utilisateurs"},
 *     @OA\RequestBody(
 *       @OA\MediaType(
 *          mediaType="multipart/form-data",
 *          @OA\Schema(
 *            @OA\Property(
 *              property="email",
 *              type="string",
 *            ), 
 *            @OA\Property(
 *              property="password",
 *              type="string",
 *            ), 
 *       ),  
 *      ),
 *    ),
 *   @OA\Response(
 *          response="200",
 *        description="Connexion de l'utilisateurr avec succès",
 *        @OA\JsonContent(ref="#/components/schemas/Users"),
 *    )
 * )
 */
  public function execute(array $userData) :?Users
  {
        $email = $userData['email'];
        $password = $userData['password'];
        $user = $this->userRepository->connect($email,$password);
        //dd($user);
        return $user;
        
 }
 
}
