<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request,AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $lastUsename = $utils->getLastUsername();
        return $this->render('security/login.html.twig', [
            'error' => $error,
            'last_username' => $lastUsename
        ]);


    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(){

        return $this->redirectToRoute('login');

    }

    /**
     * @Route("/register", name="registration")
     */
    public function register(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder) {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);

            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'succes_registration',
                "Congratulations!!! Your account has been created! You can now connect !"
            );

            return $this->redirectToRoute('login');
        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
