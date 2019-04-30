<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DepartmentRepository")
 */
class Department {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dep_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $responsible_email;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contact", mappedBy="department")
     */
    private $contacts;

    public function __construct()
    {
        $this->contacts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepName(): ?string
    {
        return $this->dep_name;
    }

    public function setDepName(string $dep_name): self
    {
        $this->dep_name = $dep_name;

        return $this;
    }

    public function getResponsibleEmail(): ?string
    {
        return $this->responsible_email;
    }

    public function setResponsibleEmail(string $responsible_email): self
    {
        $this->responsible_email = $responsible_email;

        return $this;
    }
	
	public function __toString() {
                        		return $this->dep_name;
                        	}

    /**
     * @return Collection|Contact[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->setDepartment($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->contains($contact)) {
            $this->contacts->removeElement($contact);
            // set the owning side to null (unless already changed)
            if ($contact->getDepartment() === $this) {
                $contact->setDepartment(null);
            }
        }

        return $this;
    }
}
