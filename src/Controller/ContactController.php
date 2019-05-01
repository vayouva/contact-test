<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use App\Repository\DepartmentRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

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
	 * @param ContactNotification $notification
	 *
	 * @return Response
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
	 */
	
    public function contact(Request $request, ContactNotification $notification) : Response {
    	$contact = new Contact();
    	//Creating the form and handling the request
    	$form = $this->createForm(ContactType::class, $contact);
    	$form->handleRequest($request);
    	// if the form is submitted and the data from the form is valid, we start processing the data
    	if ($form->isSubmitted() && $form->isValid()) {
    		// Adding the contact's data to the database
    		$contactData = $form->getData();
    		$this->manager->persist($contactData);
    		$this->manager->flush();
    		//setting up the flash message to display if the registration didn't went wrong
    		$this->addFlash('info', 'Your registration has been submitted successfully');
    		//sending an email to the department's responsible
    		$notification->notify($contact);
			$this->addFlash('success', "An email has been sent to the department's responsible");
			//redirect to contact page after everything is done
			return $this->redirectToRoute("contact");
		}
        return $this->render("contact/contact.html.twig", [
            'our_form' => $form->createView()
        ]);
    }
    
}
