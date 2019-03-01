<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BusrRepository")
 * @UniqueEntity(
 *  fields={"email"},
 *  message="Another user has already registered with this email address, please edit"
 * )
 */
class Busr
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5, minMessage="The number of characters is equal to or greater than 5")
     */

    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5, minMessage="The number of characters is equal to or greater than 5")
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(message="Please enter a valid email !")
     */

    private $email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $state;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\Date( message = "Invalid Date: format should be 'YYYY-mm-dd'.")
     * @var string A "Y-m-d" formatted value
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Agrp", inversedBy="busrs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $grp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname ): self
    {
        $this->firstname =  $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

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

    public function getState(): ?bool
    {
        return $this->state;
    }

    public function setState(bool $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getGrp(): ?Agrp
    {
        return $this->grp;
    }

    public function setGrp(?Agrp $grp): self
    {
        $this->grp = $grp;

        return $this;
    }



}
