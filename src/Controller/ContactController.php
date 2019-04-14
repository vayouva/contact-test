<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use App\Repository\DepartmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController {
	
	/**
	 * @var DepartmentRepository
	 */
	private $departmentRepository;
	
	/**
	 * ContactController constructor.
	 *
	 * @param DepartmentRepository $departmentRepository
	 */
	public function __construct(DepartmentRepository $departmentRepository) {
		$this->departmentRepository = $departmentRepository;
	}
	
	/**
	 * @Route("/contact", name="contact")
	 *
	 */
    public function contact(Request $request, \Swift_Mailer $mailer, ContactNotification $notification) {
    	$departments = $this->departmentRepository->findAll();
    	dump($departments);
    	$contact = new Contact();
    	$form = $this->createForm(ContactType::class);
    	$form->handleRequest($request);
    	if ($form->isSubmitted() && $form->isValid()) {
    		dump($form);
    		$notification->notify($contact);
    		$this->addFlash('success', 'Your registration has been submitted successfully');
    		$this->redirectToRoute("contact");
    		//$contactFormData = $form->getData();
    		//dump($contactFormData);
			/*$message = (new \Swift_Message('You have a new registration in your department'))
				->setFrom($contactFormData['email'])
				->setTo('abassiyouva@gmail.com')
				->setBody(
					// templates/emails/registration.html.twig
						$contactFormData['message'],
						'text/html'
				)
				/*
				 * If you also want to include a plaintext version of the message
				->addPart(
					$this->renderView(
						'emails/registration.txt.twig',
						['name' => $name]
					),
					'text/plain'
				)
				*/
			;
		
			//$mailer->send($message);
    	}
        return $this->render("contact/contact.html.twig", [
            'our_form' => $form->createView(),
			'departments' => $departments
        ]);
    }
}
