<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request,EntityManagerInterface $entityManager, UserRepository $userRepository): Response
    {
        $data = json_decode($request->getContent(), true);
        $username = $data['username'];
        $password = $data['password'];
        // Validar los datos de entrada aquí si es necesario.
        $existingUser = $userRepository->findOneBy(['username' => $username]);
        if($existingUser!== null){
            $jsonResponse = [
                'register' => false,
                'message' => 'Username already taken'
            ];
            return new JsonResponse($jsonResponse);
        }
        $user = new User();
        $user->setUsername($username);
        $user->setPassword(password_hash($password, PASSWORD_BCRYPT));

        $entityManager->persist($user);
        $entityManager->flush();
        $jsonResponse = [
            'register'=>true,
            'message' => 'User registered successfully'
        ];

        return new JsonResponse($jsonResponse);
    }
}