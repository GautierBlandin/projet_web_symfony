<?php

namespace App\Controller;

// ...

use App\Entity\Ads;
use App\Entity\Applications;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class AdsController extends AbstractController
{
    /**
     * @Route("/ads/create", name="ads")
     */
    public function createAds()
    {

    $ads = new Ads();
    $ads->setDescription('Great job, great team, good money');
    $ads->setWage('20000');
    $ads->setPlace('Paris');
    $ads->setTitle('Full stack developer');
    $ads->setCreationDate(new \DateTime());
    $ads->setEndDate(\DateTime::createFromFormat('Y-m-d', "2020-12-01"));


    $em = $this->getDoctrine()->getManager();    
    $em->persist($ads);

    // actually executes the queries (i.e. the INSERT query)
    $em->flush();

    return new Response('Saved new ad with id '.$ads->getId());
}


    /**
     * @Route("/ads", name="ads_show")
     */
    public function showAds()
    {
        $em = $this->getDoctrine()->getManager();  
        $ads = $this->getDoctrine()->getRepository(ads::class)->findAll();
 
        $formsView = array();
        $forms = array();
 
        foreach ($ads as &$ad) {
            $apply = new Apply();

            $form = $this->createForm(ApplyType::class, $apply);

            array_push($forms, $form);
            array_push($formsView, $form->createView());
 
            $form->handleRequest($request);
 
            if($form->isSubmitted() && $form->isValid()) {
                $apply = $form->getData();
                $apply->setCreatedAt(new \DateTime('now'));
                
                
                $em->persist($apply);
                $em->flush();
                return $this->redirectToRoute('ads_show');
            }
            
        }
 
        $forms = array_values($forms);
        
 
        if (!$ads) {
            throw $this->createNotFoundException(
                'No ads found');
        }
        else {
            return $this->render('test.html.twig', [
                
                // this array defines the variables passed to the template,
                // where the key is the variable name and the value is the variable value
                // (Twig recommends using snake_case variable names: 'foo_bar' instead of 'fooBar')
 
            'ads' => $ads,
            'forms' => $formsView
 
            ]);
        }    
    }


    /**
     * @Route("/ads/update/{adsId}", name="ads_update")
     */
    public function updateAds($adsId)
    {
        $em = $this->getDoctrine()->getManager();
        $ads = $em->getRepository(ads::class)->find($adsId);

        if (!$ads) {
            throw $this->createNotFoundException(
                'No ads found for id '.$adsId
            );
        }
        else{
            $ads->setTitle('Teacher');
            $em->flush();
            return new Response('Changed ad name');
        }
    }


    /**
     * @Route("/ads/delete/{adsId}", name="ads_delete")
     */
    public function deleteAds($adsId)
    {
        $em = $this->getDoctrine()->getManager();
        $ads = $em->getRepository(ads::class)->find($adsId);

        if (!$ads) {
            throw $this->createNotFoundException(
                'No ads found for id '.$adsId
            );
        }
        else{
            $em->remove($ads);
            $em->flush();
            return new Response('Deleted this ad from database.');
        }
    }
}
