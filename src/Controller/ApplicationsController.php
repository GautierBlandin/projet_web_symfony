<?php

namespace App\Controller;

// ...

use App\Entity\Applications;
use App\Entity\User;
use App\Entity\Ads;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class ApplicationsController extends AbstractController
{
    /**
     * @Route("/applications", name="applications")
     */
    public function createApplications()
    {
    $applications = new Applications();
    $applications->getAd('');
    $applications->setAppliedDate(NULL);
    $applications->setCoverLetter('je suis super motivée');
    $applications->setAvailabilities('whenever youd like');
    $applications->setAppliedDate(NULL);
  
    // tells Doctrine you want to (eventually) save the applications (no queries yet)
    $em = $this->getDoctrine()->getManager();
    $em->persist($applications);

    // actually executes the queries (i.e. the INSERT query)
    $em->flush();

    return new Response('Saved new applications with id '.$applications->getId());
}

}
