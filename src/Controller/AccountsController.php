<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Accounts;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;


class AccountsController extends AbstractController
{
    /**
     * @Route("/accounts", name="accounts")
     */
    public function index()
    {
        // Fetch the EntityManager
        $entityManager = $this->getDoctrine()->getManager();

        $accounts = new Accounts();
        $accounts->setId(73);
        $accounts->setActive(0);
        $entityManager->persist($accounts);
        
        $accounts = new Accounts();
        $accounts->setId(222);
        $accounts->setActive(1);
        $entityManager->persist($accounts);
        
        $accounts = new Accounts();
        $accounts->setId(345);
        $accounts->setActive(1);
        $entityManager->persist($accounts);

        // Execute insert query
        $entityManager->flush();

        return new Response('Saved new account with id '.$accounts->getId());
        /*
        return $this->render('accounts/index.html.twig', [
            'controller_name' => 'AccountsController',
        ]);*/
    }
}
