<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Department;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use App\Repository\DepartmentRepository;
use Doctrine\Common\Persistence\ObjectManager;
use function PHPSTORM_META\type;
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
	 * @param ContactNotification $notification
	 *
	 * @return Response
	 */
    public function contact(Request $request) : Response {
    	$form = $this->createForm(ContactType::class);
    	$form->handleRequest($request);
    	if ($form->isSubmitted() && $form->isValid()) {
    		$contact = $form->getData();
			$dep = $contact->getDepartment();
			dump($dep);
    		$this->manager->persist($contact);
    		$this->manager->flush();
    		$this->addFlash('success', 'Your registration has been submitted successfully');
			//return $this->redirectToRoute("contact");
			
			$dep_email = $this->departmentRepository->findBy(['dep_name' => $dep]);
			dump($dep_email[0]->getResponsibleEmail());
			/*$message = (new \Swift_Message('You have a new registration in your department'))
				->setFrom($contact['email'])
				->setTo($dep_email)
				->setBody(
					// templates/emails/registration.html.twig
						$contactFormData['message'],
						'text/html'
				);
		*/
			//$mailer->send($message);
    	}
        return $this->render("contact/contact.html.twig", [
            'our_form' => $form->createView()
        ]);
    }
}
