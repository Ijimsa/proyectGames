<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register', methods:"POST")]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher,UserRepository $userRepository, EntityManagerInterface $entityManager): Response
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
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $request->get('password')->getData()
                )
            );
            $user->setUsername($username); 
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return new JsonResponse(['Registration ' => true])
        ;
    }
}
