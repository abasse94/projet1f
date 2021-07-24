<?php

namespace App\Controller;

use App\Controller\Demande;
use App\Entity\Comment;
use App\Entity\Demandeur;
use App\Form\DemandeType;

use Doctrine\ORM\EntityManagerInterface;
use App\Repository\DemandeurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{


    /**
     *@Route("/home", name="app_home")
     * @return Response
     */
    public function indexe(): Response
    {
        return $this->render('home/index.html.twig');
    }
      /**
     * @Route("/login", name="app_login", methods={"GET", "POST"})
     */
    public function login(): Response
    {
        return $this->render('login.html.twig');
    }

 /**
     *@Route("/hom", name="app_hom", methods={"GET"})
     * @return Response
     */
    public function index()
    {
        return $this->render('hom.html.twig');
    }

 /**
 * @Route("/shows", name="app_shows")
 */
    
  public function shows( Request $request, EntityManagerInterface $em)
  {
       $comment = new Comment();
       $form = $this->createFormBuilder($comment)
       ->add("pseudo",TextType::class, [
           "attr" => [
               "class" => "form-control"
           ]
       ])
       ->add("content",TextareaType::class, [
        "attr" => [
            "class" => "form-control"
        ]
    ])
       ->add("submit", SubmitType::class, [
        "attr" => [
            "class" => "btn btn-primary"
        ]
    ])
       
       ->getForm();
       $comment->setCreatedAt(new \DateTime());
       

       $form->handleRequest($request);

       if($form->isSubmitted() && $form->isValid()){
            $em->persist($comment);
            $em->flush(); 
       }

    
      return $this->render('demande/shows.html.twig', [
        
          'form' => $form->createView()
      ]);
  }
  
}
