<?php

namespace App\Controller;

use App\Form\UserRegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{

    /**
     * @Route("/registre", name="app_registre", methods={"GET", "POST"})
     */
    public function registre(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder): Response
    {

        $form = $this->createForm(UserRegistrationFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
           $user = $form->getData();
           $plainPassword = $form['plainPassword']->getData();
           $user->setPassword($passwordEncoder->encodePassword($user, $plainPassword));
           $em->persist($user);
           $em->flush();

           $this->addFlash('success', 'User success');
           return $this->redirectToRoute('app_home');

        }
        return $this->render('security/registre.html.twig', [
            'restrationForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/login", name="app_login", methods={"GET", "POST"})
     */
    public function login(): Response
    {
        return $this->render('security/login.html.twig');
    }


     /**
     * @Route("/logout", name="app_logout", methods={"GET"})
     */
    public function logout(): Response
    {
        throw new \LogicException('this method');
    }
}
