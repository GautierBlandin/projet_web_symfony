<?php

namespace App\Controller;

use App\Entity\Apply;
use App\Entity\Ads;
use App\Form\ApplyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class ApplyController extends AbstractController
{

    /**
     * @Route("/apply", name="apply_test")
     */
    public function apply(Request $request)
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
                $apply->setCreatedAt(\DateTime::createFromFormat('Y-m-d', "2020-12-01"));
                
                $em->persist($apply);
                $em->flush();
                return $this->redirectToRoute('apply_test');
            }
        }
 
        $forms = array_values($forms);
        
 
        // if (!$ads) {
            // throw $this->createNotFoundException(
                // 'No ads found');
        // }
        // else {
            return $this->render('apply_form/apply.html.twig', [
                
                // this array defines the variables passed to the template,
                // where the key is the variable name and the value is the variable value
                // (Twig recommends using snake_case variable names: 'foo_bar' instead of 'fooBar')
 
            // 'ads' => $ads,
            'forms' => $formsView

 
            ]);
        // }    
        // creates a task object and initializes some data for this example
        
    }

}
