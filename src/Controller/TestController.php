<?php
// src/Controller/TestController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestController extends AbstractController
{
    public function contacts()
    {
        $number = random_int(0, 100);

        return $this->render('test/contacts.html.twig', [
            'number' => $number,
        ]);
    }
    
    public function filtered($type)
    {
    	if (strtolower($type) == 'active') {
    		// TODO: query for active contacts
    		$contacts = array(
    			0 => array(
    				"accountId" => 345, "numContacts" => 2,
    					"contacts" => array(0 => array(
    						"contactId" => 102,
    						"lastName" => 'Does',
    						"firstName" => 'John'),
    					1 => array(
    						"contactId" => 105,
    						"lastName" => 'Does',
    						"firstName" => 'Jane')
    				)
    			),
    			1 => array(
    			"accountId" => 222, "numContacts" => 1,
    				"contacts" => array(0 => array(
    					"contactId" => 42,
    					"lastName" => 'Adams',
    					"firstName" => 'Douglas')
    				)
    			)
    		);
    		
        } elseif (strtolower($type) == 'inactive') {
        	// TODO: query for inactive contacts
        	$contacts = array(0 => array(
    		"accountId" => 73, "numContacts" => 2,
    			"contacts" => array(0 => array(
    				"contactId" => 12,
    				"lastName" => 'White',
    				"firstName" => 'Benny'),
    			1 => array(
    				"contactId" => 78,
    				"lastName" => 'White',
    				"firstName" => 'Besty')
    			)
    		));
        } else {
        	$contacts = array(
        		// TODO: query for all
    			0 => array(
    				"accountId" => 345, "numContacts" => 2,
    					"contacts" => array(0 => array(
    						"contactId" => 102,
    						"lastName" => 'Does',
    						"firstName" => 'John'),
    					1 => array(
    						"contactId" => 105,
    						"lastName" => 'Does',
    						"firstName" => 'Jane')
    				)
    			),
    			1 => array(
    				"accountId" => 222, "numContacts" => 1,
    					"contacts" => array(0 => array(
    						"contactId" => 42,
    						"lastName" => 'Adams',
    						"firstName" => 'Douglas')
    				)
    			),
    			2 => array(
    				"accountId" => 345, "numContacts" => 2,
    					"contacts" => array(0 => array(
    						"contactId" => 102,
    						"lastName" => 'Does',
    						"firstName" => 'John'),
    					1 => array(
    						"contactId" => 105,
    						"lastName" => 'Does',
    						"firstName" => 'Jane')
    				)
    			)
    		);
        }
        return $this->render('test/filtered.html.twig', [
            	'contacts' => $contacts,
        ]);
        
    }
}