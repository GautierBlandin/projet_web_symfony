<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\JobAd;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class JobAdController extends AbstractController
{
    /**
     * @Route("/job/ad", name="create_job_ad")
     */
    public function createJobAd(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $jobAd = new JobAd();
        $jobAd->setTitle("Eleveur de Dragodindes 2");
        $jobAd->setDescription("Elever des dragodindes en masse");
        $jobAd->setCompanyName("SkipTheGrind 2");

        $entityManager->persist($jobAd);

        $entityManager->flush();

        return new Response('Saved new product with id '.$jobAd->getId());
    }

    /**
     * @Route("/job/ad/{id}", name="product_show")
     */
    public function show($id)
    {
        $jobAd = $this->getDoctrine()
            ->getRepository(JobAd::class)
            ->find($id);

        if (!$jobAd) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

//        return new Response('Check out this great product: '.$jobAd->getTitle());

        // or render a template
        // in the template, print things with {{ product.name }}
         return $this->render('product/show.html.twig', ['jobAd' => $jobAd]);
    }

}
