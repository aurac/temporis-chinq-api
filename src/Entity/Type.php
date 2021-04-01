<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={
 *          "get"={}
 *     },
 *     normalizationContext={"groups"={"type:read"}, "swagger_definition_name"="Read"},
 *     denormalizationContext={"groups"={"type:write"}},
 *     shortName="types",
 *     attributes={
 *          "pagination_enabled"=false
 *     }
 * )
 * @ORM\Entity(repositoryClass=TypeRepository::class)
 */
class Type
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"type:read", "subtype:read", "item:read"})
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"type:read", "subtype:read", "item:read"})
     */
    private string $name;

    /**
     * @ORM\OneToMany(targetEntity=SubType::class, mappedBy="type")
     * @Groups({"type:read"})
     */
    private Collection $subTypes;

    public function __construct()
    {
        $this->subTypes = new ArrayCollection();
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
     * @return Collection|SubType[]
     */
    public function getSubTypes(): Collection
    {
        return $this->subTypes;
    }

    public function addSubType(SubType $subType): self
    {
        if (!$this->subTypes->contains($subType)) {
            $this->subTypes[] = $subType;
            $subType->setType($this);
        }

        return $this;
    }

    public function removeSubType(SubType $subType): self
    {
        if ($this->subTypes->removeElement($subType)) {
            // set the owning side to null (unless already changed)
            if ($subType->getType() === $this) {
                $subType->setType(null);
            }
        }

        return $this;
    }
}
