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
			'3' => 'Development',
			'4' => 'Communication',
			'5' => 'Accounting'
		];
		$contact = new Contact();
		$contact->setFirstName('John');
		$contact->setLastName('Doe');
		$contact->setEmail('john.doe@example.com');
		$contact->setDepartment("Human resources");
		$contact->setMessage('Hello, I would like to get more infomations about your products, call me back please.');
		$manager->persist($contact);
		
		foreach ($departmentsNames as $i) {
			$department = new Department();
			$department->setDepName($i);
			$department->setResponsibleEmail(strtolower(str_replace(' ', '_', $i)).'.responsible@example.com');
			$manager->persist($department);
		}

        $manager->flush();
    }
}
