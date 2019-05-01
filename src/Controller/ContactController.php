<?php

namespace App\Controller;

use App\Entity\Department;
use App\Form\ContactType;
use App\Repository\DepartmentRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Swift_Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController {
	
	/**
	 * @var DepartmentRepository
	 */
	private $departmentRepository;
	
	/**
	 * @var ObjectManager
	 */
	private $manager;
	
	/**
	 * ContactController constructor.
	 *
	 * @param DepartmentRepository $departmentRepository
	 * @param ObjectManager $manager
	 */
	public function __construct(DepartmentRepository $departmentRepository, ObjectManager $manager) {
		$this->departmentRepository = $departmentRepository;
		$this->manager = $manager;
	}
	
	/**
	 * @Route("/contact", name="contact")
	 * @param Request $request
	 * @param Swift_Mailer $mailer
	 *
	 * @return Response
	 */
	
    public function contact(Request $request, Swift_Mailer $mailer) : Response {
    	//Creating the form and handling the request
    	$form = $this->createForm(ContactType::class);
    	$form->handleRequest($request);
    	// if the form is submitted and the data from the form is valid, we start processing the data
    	if ($form->isSubmitted() && $form->isValid()) {
    		// Adding the contact's data to the database
    		$contactData = $form->getData();
    		$this->manager->persist($contactData);
    		$this->manager->flush();
    		//setting up the flash message to display if the registration didn't went wrong
    		$this->addFlash('success', 'Your registration has been submitted successfully');
    		$message = (new \Swift_Message('You have a new registration in your department'))
				->setFrom($contactData->getEmail())
				->setTo(($contactData->getDepartment())->getResponsibleEmail())
				->setBody(
					$contactData->getMessage(),
					'text/plain'
				);
    
			$mailer->send($message);
			//return $this->redirectToRoute("contact");
		}
        return $this->render("contact/contact.html.twig", [
            'our_form' => $form->createView()
        ]);
    }
    
    private function registerContactTodb($form) {
    
	}
}
