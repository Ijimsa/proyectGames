<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTDecodeFailureException;
use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
/**
 * @Route("/api", name="api_")
 */
class DashboardController extends AbstractController
{
    private $jwtManager;

    public function __construct(JWTTokenManagerInterface $jwtManager)
    {
        $this->jwtManager = $jwtManager;
    }
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/DashboardController.php',
        ]);
    }
    #[Route('/getUser', name: 'app_dashboard',methods: 'POST')]
    public function getUserByToken(Request $request,UserRepository $userRepository)
    {
        try {
            $token = $request->headers->get('Authorization');
            $tokenParts = explode(".", $token);  
            $tokenHeader = base64_decode($tokenParts[0]);
            $tokenPayload = base64_decode($tokenParts[1]);
            $jwtPayload = json_decode($tokenPayload);
            $json = [
                'username' => $jwtPayload->username
            ];
            return new JsonResponse($json);
        } catch (JWTDecodeFailureException $e) {
            // manejar la excepción
        }

        // hacer algo con el usuario...
    }
}
