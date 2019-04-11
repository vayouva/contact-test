<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture {
    public function load(ObjectManager $manager) {
		for ($i = 0; $i < 5; $i++) {
			$contact = new Contact();
			$contact->setFirstName('John');
			$contact->setLastName('Doe');
			$contact->setEmail('john.doe@example.com');
			$contact->setMessage('Hello, I would like to get more informations about your products, call me back please.');
			$manager->persist($contact);
		}

        $manager->flush();
    }
}
