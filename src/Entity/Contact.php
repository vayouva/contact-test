<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */
class Contact
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="first_name", type="string", length=255)
	 * @Assert\NotBlank()
	 * @Assert\Length(min="2", max="100")
     */
    private $first_name;

    /**
     * @ORM\Column(name="last_name", type="string", length=255)
	 * @Assert\NotBlank()
	 * @Assert\Length(min="2", max="100")
     */
    private $last_name;

    /**
     * @ORM\Column(name="email", type="string", length=255)
	 * @Assert\NotBlank()
	 * @Assert\Length(min="2", max="100")
     */
    private $email;
    
    /**
     * @ORM\Column(name="message", type="text")
	 * @Assert\NotBlank()
	 * @Assert\Length(min="10")
     */
    private $message;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Department", inversedBy="contacts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $department;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    
    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function setDepartment(?Department $department): self
    {
        $this->department = $department;

        return $this;
    }
}
