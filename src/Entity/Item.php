<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ItemRepository;
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
 *     normalizationContext={"groups"={"item:read"}, "swagger_definition_name"="Read"},
 *     denormalizationContext={"groups"={"item:write"}},
 *     shortName="items"
 * )
 * @ORM\Entity(repositoryClass=ItemRepository::class)
 */
class Item
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"item:read", "card:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"item:read", "card:read"})
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"item:read", "card:read"})
     */
    private $level;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"item:read", "card:read"})
     */
    private $link;

    /**
     * @ORM\ManyToOne(targetEntity=SubType::class, inversedBy="items")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"item:read", "card:read"})
     */
    private $subType;

    /**
     * @ORM\OneToMany(targetEntity=Recipe::class, mappedBy="item")
     * @Groups({"item:read"})
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

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getSubType(): ?SubType
    {
        return $this->subType;
    }

    public function setSubType(?SubType $subType): self
    {
        $this->subType = $subType;

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
            $recipe->setItem($this);
        }

        return $this;
    }

    public function removeRecipe(Recipe $recipe): self
    {
        if ($this->recipes->removeElement($recipe)) {
            // set the owning side to null (unless already changed)
            if ($recipe->getItem() === $this) {
                $recipe->setItem(null);
            }
        }

        return $this;
    }
}
