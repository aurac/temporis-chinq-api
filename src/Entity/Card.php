<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={"get", "post"},
 *     itemOperations={
 *          "get"={},
 *          "put"
 *     },
 *     normalizationContext={"groups"={"card:read"}, "swagger_definition_name"="Read"},
 *     denormalizationContext={"groups"={"card:write"}},
 *     shortName="cards"
 * )
 * @ORM\Entity(repositoryClass=CardRepository::class)
 */
class Card
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"card:read", "item:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"card:read", "item:read"})
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"card:read", "item:read"})
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"card:read", "item:read"})
     */
    private $level;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"card:read", "item:read"})
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Recipe::class, mappedBy="cards")
     * @Groups({"card:read"})
     */
    private $recipes;

    public function __construct()
    {
        $this->recipes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
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

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Recipe[]
     */
    public function getRecipes(): Collection
    {
        return $this->recipes;
    }

    public function addRecipe(Recipe $recipe): self
    {
        if (!$this->recipes->contains($recipe)) {
            $this->recipes[] = $recipe;
            $recipe->addCard($this);
        }

        return $this;
    }

    public function removeRecipe(Recipe $recipe): self
    {
        if ($this->recipes->removeElement($recipe)) {
            $recipe->removeCard($this);
        }

        return $this;
    }
}
