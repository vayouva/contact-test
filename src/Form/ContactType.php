<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Department;
use App\Repository\DepartmentRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType {
	
	/**
	 * @var DepartmentRepository
	 */
	private $departmentRepository;
	
	/**
	 * ContactType constructor.
	 *
	 * @param DepartmentRepository $departmentRepository
	 */
	public function __construct(DepartmentRepository $departmentRepository) {
		$this->departmentRepository = $departmentRepository;
	}
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('first_name', TextType::class, [
					'label' => 'First Name'
			])
			->add('last_name', TextType::class, [
					'label' => 'Last Name'
			])
			->add('email', EmailType::class, [
					'label' => 'Email'
			])
			->add('department', EntityType::class, [
				'required' => true,
				'class' => Department::class,
				'multiple' => false
			])
			->add('message', TextareaType::class, [
				'label' => 'Message'
			]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
			'data_class' => Contact::class
        ]);
    }
}
