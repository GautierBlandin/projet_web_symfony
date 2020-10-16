<?php

namespace App\Controller;

use App\Form\ApplyType;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Apply;
use App\Entity\Ads;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class UserCMSController extends AbstractController
{

    /**
     * @Route("/userMenu", name="userMenu")
     */

    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->findOneByEmail($this->getUser()->getUsername());
        $applications = $user->getApplies();

        /*foreach ($applications as $application) {
        $applys = $em->getRepository(applys::class)->find($applications.getapply());
        }*/
        return $this->render('user_cms/user-menu.html.twig', [
            'controller_name' => 'UserCMSController',
            'user' => $user,
            'applications' => $applications,
                        
        ]);
    }

    /**
     * @Route("/deleteApplication/{id}", name="deleteApplication")
     */
    public function deleteApply($id){

        $em = $this->getDoctrine()->getManager();
        $apply = $em->getRepository(Apply::class)->find($id);

        if (!$apply) {
            throw $this->createNotFoundException('No apply found');
        }

        $em->remove($apply);
        $em->flush();

        return $this->redirect($this->generateUrl('userMenu'));
    }

    /**
     * @Route("/showApplication/{id}", name="showApplication")
     */
    public function showApply($id){

        $em = $this->getDoctrine()->getManager();
        $apply = $em->getRepository(Apply::class)->find($id);

        if (!$apply) {
            throw $this->createNotFoundException('No application found');
        }
        

        return $this->redirect($this->generateUrl('userMenu'));
    }


    /**
     * @Route("/updateApplication/{id}", name="updateApply")
     */
    public function updateApply(Apply $apply, Request $request, $id){

        $em = $this->getDoctrine()->getManager();
        $apply = $em->getRepository(Apply::class)->find($id);
        $newApply = false;

        $form = $this->createForm(ApplyType::class, $apply);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $apply = $form->getData();
            $apply->setUpdatedAt(new \DateTime('now'));

            $em->persist($apply);
            $em->flush();

            return $this->redirectToRoute('userMenu');
        }

        return $this->render('user_cms/update-form.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/showUser/{id}", name="showUser")
     */
    public function showUser($username){

        $em = $this->getDoctrine()->getManager();
        $apply = $em->getRepository(Apply::class)->find($id);

        if (!$apply) {
            throw $this->createNotFoundException('No application found');
        }
        

        return $this->redirect($this->generateUrl('userMenu'));
    }


    /**
     * @Route("/updateUser/{id}", name="updateUser")
     */
    public function updateApply(Apply $apply, Request $request, $id){

        $em = $this->getDoctrine()->getManager();
        $apply = $em->getRepository(Apply::class)->find($id);
        $newApply = false;

        $form = $this->createForm(ApplyType::class, $apply);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $apply = $form->getData();
            $apply->setUpdatedAt(new \DateTime('now'));

            $em->persist($apply);
            $em->flush();

            return $this->redirectToRoute('userMenu');
        }

        return $this->render('user_cms/update-form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
