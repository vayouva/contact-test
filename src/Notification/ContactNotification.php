<?php


namespace App\Notification;

use App\Entity\Contact;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ContactNotification {
	/**
	 * @var \Swift_Mailer
	 */
	private $mailer;
	/**
	 * @var Environment
	 */
	
	private $renderer;
	/**
	 * ContactNotification constructor.
	 *
	 * @param \Swift_Mailer $mailer
	 * @param Environment $renderer
	 */
	
	public function __construct(\Swift_Mailer $mailer, Environment $renderer) {
		$this->mailer = $mailer;
		$this->renderer = $renderer;
	}
	
	/**
	 * @param Contact $contact
	 *
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
	 */
	public function notify(Contact $contact) {
		$message = (new \Swift_Message('You have a new registration in your department'))
			->setFrom($contact->getEmail())
			->setTo(($contact->getDepartment())->getResponsibleEmail())
			//->setTo('your real email address')
			->setBody($this->renderer->render('emails/contact.html.twig', [
					'contact' => $contact
				]),
				'text/html'
			);
		
		$this->mailer->send($message);
	}
}