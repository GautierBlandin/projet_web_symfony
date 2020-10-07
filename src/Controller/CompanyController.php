<?php

namespace App\Controller;

// ...

use App\Entity\User;
use App\Entity\Ads;
use App\Entity\Company;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends AbstractController
{
    /**
     * @Route("/company/create", name="company")
     */
    public function createCompany()
    {

    $company = new Company();
    $company->setName('Comp');
    $company->setCity('New York');
  
    // tells Doctrine you want to (eventually) save the company (no queries yet)
    $em = $this->getDoctrine()->getManager();
    $em->persist($company);

    // actually executes the queries (i.e. the INSERT query)
    $em->flush();

    return new Response('Saved new company with id '.$company->getId()
                    );
}


    /**
     * @Route("/company/show/{companyId}", name="company_show")
     */
    public function showCompany($companyId)
    {
        $company = $this->getDoctrine()
            ->getRepository(Company::class)
            ->find($companyId);

        if (!$company) {
            throw $this->createNotFoundException(
                'No company found for id '.$companyId);
        }
        else {
            return new Response('Found company with id:' .$companyId);
        }
    }


    /**
     * @Route("/company/update/{companyId}", name="company_update")
     */
    public function updateCompany($companyId)
    {
        $em = $this->getDoctrine()->getManager();
        $company = $em->getRepository(Company::class)->find($companyId);

        if (!$company) {
            throw $this->createNotFoundException(
                'No company found for id '.$companyId
            );
        }
        else{
            $company->setName('New name!');
            $em->flush();
            return new Response('Changed company name');
        }
    }


    /**
     * @Route("/company/delete/{companyId}", name="company_delete")
     */
    public function deleteCompany($companyId)
    {
        $em = $this->getDoctrine()->getManager();
        $company = $em->getRepository(Company::class)->find($companyId);

        if (!$company) {
            throw $this->createNotFoundException(
                'No company found for id '.$companyId
            );
        }
        else{
            $em->remove($company);
            $em->flush();
            return new Response('deleted this company in database');
        }
    }
}