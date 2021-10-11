<?php

namespace App\Entity;

use App\Repository\OwnerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OwnerRepository::class)
 */
class Owner
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $familyName;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity=Room::class, mappedBy="owner", orphanRemoval=true)
     */
    private $Owner_room;

    public function __construct()
    {
        $this->Owner_room = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getFamilyName(): ?string
    {
        return $this->familyName;
    }

    public function setFamilyName(string $familyName): self
    {
        $this->familyName = $familyName;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|Room[]
     */
    public function getOwnerRoom(): Collection
    {
        return $this->Owner_room;
    }

    public function addOwnerRoom(Room $ownerRoom): self
    {
        if (!$this->Owner_room->contains($ownerRoom)) {
            $this->Owner_room[] = $ownerRoom;
            $ownerRoom->setOwner($this);
        }

        return $this;
    }

    public function removeOwnerRoom(Room $ownerRoom): self
    {
        if ($this->Owner_room->removeElement($ownerRoom)) {
            // set the owning side to null (unless already changed)
            if ($ownerRoom->getOwner() === $this) {
                $ownerRoom->setOwner(null);
            }
        }

        return $this;
    }
    
    public function __toString(){
        return $this->firstname;
    }
}
