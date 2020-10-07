<?php

// src/Controller/UserController.php
namespace App\Controller;

use App\Entity\JobAd;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class TestController extends AbstractController
{

    /**
     * @Route("/testing/{id}", name="testingpageid")
     */
    public function notifications($id)
    {
        $product = $this->getDoctrine()
            ->getRepository(JobAd::class)
            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }



        // the template path is the relative file path from `templates/`
        return $this->render('test.html.twig', [
            // this array defines the variables passed to the template,
            // where the key is the variable name and the value is the variable value
            // (Twig recommends using snake_case variable names: 'foo_bar' instead of 'fooBar')
            'name' => "TEST",
            'jobAd' => $product,
        ]);
    }

    /**
     * @Route("/testing", name="testing_page")
     */

    public function notifications2()
    {

        $product = $this->getDoctrine()
            ->getRepository(JobAd::class)
            ->find(2);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id 2'
            );
        }

        // the template path is the relative file path from `templates/`
        return $this->render('test.html.twig', [
            // this array defines the variables passed to the template,
            // where the key is the variable name and the value is the variable value
            // (Twig recommends using snake_case variable names: 'foo_bar' instead of 'fooBar')
            'name' => "TEST",
            'jobAd' => $product,
        ]);
    }

    /**
     * @Route("/product/{id}", name="product_show")
     */
    public function show($id)
    {
        $product = $this->getDoctrine()
            ->getRepository(JobAd::class)
            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        return new Response('Check out this great product: '.$product->getDescription());

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }
}
