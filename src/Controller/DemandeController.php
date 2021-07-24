<?php

namespace App\Controller;

use App\Entity\Certificat;
use App\Entity\Demandeur;
use App\Form\CertificatType;
use App\Form\DemandeType;
use App\Repository\CertificatRepository;
use App\Repository\DemandeurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemandeController extends AbstractController
{

     /**
     * @Route("/show/{id}", name="app_show", methods={"GET"})
     */

    public function show(DemandeurRepository $repo, Demandeur $demandeur): Response
    {
     
         $demandeur = $repo->find($demandeur);
        return $this->render('demande/show.html.twig',[
            'demandeur' => $demandeur
         ] );
    }

    /**
     *@Route("/demande", name="app_demande")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $em): Response
    {
       
        $demandeur = new Demandeur();
        $form = $this->createForm(DemandeType::class, $demandeur);


        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->addFlash('success', 'inscription reusit');
            $em = $this->getDoctrine()->getManager();

            $em->persist($demandeur);
            $em->flush();
             return $this->redirectToRoute('app_show', ['id' => $demandeur->getId()]);
            
        }
        return $this->render('demande/index.html.twig',[
             "form" => $form->createView(),

            'demandeur' => $demandeur
        ]);
       
    }


     /**
     * @Route("/show1/{id}", name="app_show1", methods={"GET"})
     */

    public function show1(CertificatRepository $repo, certificat $certificat): Response
    {
     
         $certificat = $repo->find($certificat);
        return $this->render('demande/show1.html.twig',[
            'certificat' => $certificat
         ] );
    }

 /**
     *@Route("/certificat", name="app_certificat")
     * @param Request $request
     * @return Response
     */
    public function certificat(Request $request, EntityManagerInterface $em): Response
    {
       
        $certificat = new Certificat();
        $form = $this->createForm(CertificatType::class, $certificat);


        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->addFlash('success', 'inscription reusit');
            $em = $this->getDoctrine()->getManager();

            $em->persist($certificat);
            $em->flush();
             return $this->redirectToRoute('app_show1', ['id' => $certificat->getId()]);
            
        }
        return $this->render('demande/index1.html.twig',[
             "form" => $form->createView(),

            'certificat' => $certificat
        ]);
       
    }
/**
 * @route("/certificat/{id}/delet", name="certificat_delete")
 */

public function delet(Certificat $certificat): RedirectResponse
{
    $em = $this->getDoctrine()->getManager();
    $em->remove($certificat);
    $em->flush();

    return $this->redirectToRoute("app_home");
}




/**
 * @route("/demande/{id}/delete", name="demande_delete")
 */

public function delete(demandeur $demandeur): RedirectResponse
{
    $em = $this->getDoctrine()->getManager();
    $em->remove($demandeur);
    $em->flush();

    return $this->redirectToRoute("app_home");
}

  
} 
