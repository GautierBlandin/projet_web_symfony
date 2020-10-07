<?php

namespace App\Controller;

// ...
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    /**
     * @Route("/User", name="User")
     */
    public function createUser(): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $user = new user();
        $user->setAdmin('false');
        $user->setEmail("muster.mann@test.com");
        $user->setPassword('');
        $user->setFirstName('Muster');
        $user->setLastName('Mann');
        $user->setAdress('Musterstrasse, musternummer, musterstadt, musterland');
        $user->setPhoneNumber('');
        $user->setAge(NULL);
        $user->setStudies('');
        $user->setGender('');
        $user->setExperience('');
        $user->setResume('');
        $user->setAvailabilities('');
        $user->setBiography('');



        // tell Doctrine you want to (eventually) save the user (no queries yet)
        $entityManager->persist($user);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new user with id '.$user->getId());
        
        }
}
