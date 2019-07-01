<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contacts;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ContactsController extends AbstractController
{
    /**
     * @Route("/contacts", name="contacts")
     */
    public function index()
    {
        // Defaults to showing all contacts
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $repository = $this->getDoctrine()->getRepository(Contacts::class);
        
        $sort = $this->cleanSort($sort);
                 
        $dir = $this->cleanSortDir($dir);
        
        $contacts = $repository->findAllContacts($sort, $dir);
        
        if (!isset($contacts) || !$contacts) {
            $contacts = array('error' => 'No contacts found');
        }
        
        $jsonContacts = $serializer->serialize($contacts, 'json');
        
        $headers = array(
            'Content-Type' => 'application/json'
        );
    
        $response = new Response($jsonContacts, 200, $headers);

        return $response;
    }
    
    /**
     * Show contacts
     * 
     * @Route("/contacts/{type}/{state}/{sort}/{dir}", name="contacts_type")
     */
    public function show($type = 'all', $state = 'all', $sort = 'id', $dir = 'ASC')
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $repository = $this->getDoctrine()->getRepository(Contacts::class);
        
        $sort = $this->cleanSort($sort);
                 
        $dir = $this->cleanSortDir($dir);
    
        // Check for type, default to all
        if ($type != 'active' && $type != 'inactive') {
            $type = 'all';
        }
        // Check for state, default to all
        if (strlen($state) != 2 && !ctype_alpha($state)) {
            $state = 'all';
        } else {
            $state = strtoupper($state);
        }
            
        $contacts = $repository->findContacts($type, $state, $sort, $dir);
        
        if (!isset($contacts) || !$contacts) {
            $contacts = array('error' => 'No contacts found');
        }
        
        $jsonContacts = $serializer->serialize($contacts, 'json');
        
        $headers = array(
            'Content-Type' => 'application/json'
        );
    
        $response = new Response($jsonContacts, 200, $headers);

        return $response;
    }

    // @var $sort
    // returns string
    private function cleanSort($sort) {
        // Clean the sort param, default to sorting by id
        $sort = (in_array($sort, array('id', 'accountId', 'firstName', 'lastName',
                 'address1', 'address2', 'city', 'state', 'postalCode', 'email',
                 'accountOwner', 'active'))) ? 'c.' . $sort : 'c.id';
                 
        return $sort;
    }
    
    // @var $dir
    // returns string
    private function cleanSortDir($dir) {
        // Clean the sort direction param, default to ASC   
        $dir = strtoupper($dir); 
        $dir = (in_array($dir, array('ASC', 'DESC'))) ? $dir : 'ASC';
                 
        return $dir;
    }
}
