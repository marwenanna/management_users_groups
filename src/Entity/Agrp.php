<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ORM\Entity(repositoryClass="App\Repository\AgrpRepository")
 * @UniqueEntity(
 *  fields={"name"},
 *  message="This group already exists with this name, thank you to modify it"
 * )
 */
class Agrp
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="You must enter a group")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Busr", mappedBy="grp")
     */
    private $busrs;

    public function __construct()
    {
        $this->busrs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Busr[]
     */
    public function getBusrs(): Collection
    {
        return $this->busrs;
    }

    public function addBusr(Busr $busr): self
    {
        if (!$this->busrs->contains($busr)) {
            $this->busrs[] = $busr;
            $busr->setGrp($this);
        }

        return $this;
    }

    public function removeBusr(Busr $busr): self
    {
        if ($this->busrs->contains($busr)) {
            $this->busrs->removeElement($busr);
            // set the owning side to null (unless already changed)
            if ($busr->getGrp() === $this) {
                $busr->setGrp(null);
            }
        }

        return $this;
    }
}
