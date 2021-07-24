<?php

namespace App\Controller;

use App\Entity\Images;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    // #[Route('/image', name: 'image')]
    // public function index(): Response
    // {
    //     return $this->render('image/index.html.twig', [
    //         'controller_name' => 'ImageController',
    //     ]);
    // }


    /**
     * @Route("/image")
     */
    public function imageAction(Images $image){
        $em = $this->getDoctrine()->getManager();
        $image = $em->getRepository('Image')->findAll();
        foreach($image as $key=>$value){
            $value->setImage(base64_encode(stream_get_contents($value->getImage())));
        }
        return $this->render("image/index.html.twig", array('images'=>$image));
    }
}
