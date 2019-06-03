<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\PhoneNumbers;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class PhoneNumbersController extends AbstractController
{
    /**
     * @Route("/phone/numbers", name="phone_numbers")
     */
    public function index()
    {
        return $this->render('phone_numbers/index.html.twig', [
            'controller_name' => 'PhoneNumbersController',
        ]);
    }
}
