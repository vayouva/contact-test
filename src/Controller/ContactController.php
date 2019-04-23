<?php

namespace App\Controller;

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
    	$form = $this->createForm(ContactType::class);
    	$form->handleRequest($request);
    	if ($form->isSubmitted() && $form->isValid()) {
    		$contact = $form->getData();
			$dep = $contact->getDepartment();
    		$this->manager->persist($contact);
    		$this->manager->flush();
    		$this->addFlash('success', 'Your registration has been submitted successfully');
			//$dep_data[0]->getResponsibleEmail()
			$dep_data = $this->departmentRepository->findBy(['dep_name' => $dep]);
			dump($dep_data[0]->getResponsibleEmail());
			$message = (new \Swift_Message('You have a new registration in your department'))
				->setFrom($contact->getEmail())
				->setTo($dep_data[0]->getResponsibleEmail())
				->setBody(
					$contact->getMessage(),
					'text/plain'
				);
			$mailer->send($message);
			return $this->redirectToRoute("contact");
		
		}
        return $this->render("contact/contact.html.twig", [
            'our_form' => $form->createView()
        ]);
    }
}
