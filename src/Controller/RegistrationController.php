<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\UserAuthenticator;
use App\Service\JWTService;
use App\Service\SendMailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(
        Request                     $request,
        UserPasswordHasherInterface $userPasswordHasher,
        UserAuthenticatorInterface  $userAuthenticator,
        UserAuthenticator           $authenticator,
        EntityManagerInterface      $entityManager,
        SendMailService             $sendMailService,
        JWTService                  $JWTService
    ): Response
    {
        //TODO corrige template form

        //TODO regle ce probleme
        //var_dump($this->getParameter('app.jwtsecret'));

        //pass 'identique'
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();


            //you generate a  activation link on JWT token |

            //- le Header
            $header = [
                'typ' => 'JWT',
                'alg' => 'HS256'
            ];

            //-le payload
            $payload = ['user_id' => $user->getId()];

            //-genere le token
            //TODO active ds service.yaml '0hLa83lleBroue11e!'
            //$token = $JWTService->generate($header,$payload, $this->getParameter('app.jwtsecret'));
            $token = $JWTService->generate($header, $payload, '0hLa83lleBroue11e!');

            //TODO envoie email
//            //on envoie l'email
//
//            // do anything else you need here, like send an email
//            /**
//             * @var SendMailService $sendMailService
//             */
//            $sendMailService->send(
//                'no-reply@monsite.net',
//                $user->getEmail(),
//                'Your inscription',
//                'template-register',
//                compact('user')
//            );

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/verif/{token}', name: 'verify_user')]
    public function verifUser($token, JWTService $JWTService): Response
    {
        $var = $JWTService->getPayload($token);
        dd($token);
    }
}

