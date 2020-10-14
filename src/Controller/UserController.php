<?php

namespace App\Controller;

// ...
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Form\CompanyContactType;
use App\Entity\Company;

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

    /**
     * @Route("/register-menu", name = "registerMenu")
     */

    public function register_menu()
    {
        return $this->render('register-menu.html.twig', [
        ]);
    }

    /**
     * @Route("/register-company", name = "registerCompany")
     */

    public function register_company(Request $request)
    {
        $user = new User();
        $company = new Company();
        $form = $this->createForm(CompanyContactType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $user = $form->getData();
            $user->setAdmin(false);
            $company = $user->getCompany();

            // tells Doctrine you want to (eventually) save the company (no queries yet)
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->persist($company);

            // actually executes the queries (i.e. the INSERT query)
            $em->flush();

            return $this->redirectToRoute("app_login");
        }

        return $this->render('register-company.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/register", name="registerPage")
     */

    public function new_user(Request $request)
    {
        // just setup a fresh $task object (remove the example data)
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $user = $form->getData();
            $user->setAdmin(false);

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();

            // tells Doctrine you want to (eventually) save the company (no queries yet)
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);

            // actually executes the queries (i.e. the INSERT query)
            $em->flush();

            return $this->redirectToRoute("app_login");
        }

        return $this->render('register-user.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}