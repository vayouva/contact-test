<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use App\Entity\Department;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture {
    public function load(ObjectManager $manager) {
    	$departmentsNames = [
    		'1' => 'Direction',
			'2' => 'Human Resources',
			'3' => 'Communication',
			'4' => 'Accounting'
		];
  		
    	// Creating the first department to relate it to the contact below
    	$department = new Department();
    	$department->setDepName('Development');
    	$department->setResponsibleEmail('testitefficence@gmail.com');
		$manager->persist($department);
    	
		$contact = new Contact();
		$contact->setFirstName('John');
		$contact->setLastName('Doe');
		$contact->setEmail('john.doe@example.com');
		$contact->setDepartment($department);
		$contact->setMessage('Hello, I would like to get more informations about your products, call me back please.');
		$manager->persist($contact);
		
		foreach ($departmentsNames as $i) {
			$department = new Department();
			$department->setDepName($i);
			$department->setResponsibleEmail('testitefficence@gmail.com');
			$manager->persist($department);
		}

        $manager->flush();
    }
}
