<?php

namespace App\Entity;

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
}
