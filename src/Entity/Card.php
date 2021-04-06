<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;
use App\Repository\CardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

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
 * @ApiFilter(PropertyFilter::class)
 * @ApiFilter(SearchFilter::class, properties={"recipes.item.name":"ipartial"})
 */
class Card
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"card:read", "item:read", "recipe:read", "recipe:write","recipelevel:read", "recipelevel:write"})
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"card:read", "card:write", "item:read", "recipe:write", "recipe:read", "recipelevel:read"})
     * @Assert\NotBlank
     */
    private string $name;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"card:read", "card:write", "item:read", "recipe:write", "recipe:read", "recipelevel:read"})
     * @Assert\GreaterThan(0)
     * @Assert\NotBlank
     */
    private int $level;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"card:read", "card:write", "item:read", "recipe:write", "recipe:read", "recipelevel:read"})
     */
    private ?string $description;

    /**
     * @ORM\ManyToMany(targetEntity=Recipe::class, mappedBy="cards")
     * @Groups({"card:read"})
     */
    private Collection $recipes;

    /**
     * @ORM\ManyToMany(targetEntity=RecipeLevel::class, mappedBy="cards")
     * @Groups({"card:read"})
     */
    private Collection $recipeLevels;

    public function __construct()
    {
        $this->recipes = new ArrayCollection();
        $this->recipeLevels = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @Groups("card:read")
     */
    public function getShortDescription(): ?string
    {
        if (strlen($this->description) < 40) {
            return $this->description;
        }
        return substr($this->description, 0, 40);
    }

    /**
     * @SerializedName("description")
     * @param string|null $description
     * @return Card
     */
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

    /**
     * @return Collection|RecipeLevel[]
     */
    public function getRecipeLevels(): Collection
    {
        return $this->recipeLevels;
    }

    public function addRecipeLevel(RecipeLevel $recipeLevel): self
    {
        if (!$this->recipeLevels->contains($recipeLevel)) {
            $this->recipeLevels[] = $recipeLevel;
            $recipeLevel->addCard($this);
        }

        return $this;
    }

    public function removeRecipeLevel(RecipeLevel $recipeLevel): self
    {
        if ($this->recipeLevels->removeElement($recipeLevel)) {
            $recipeLevel->removeCard($this);
        }

        return $this;
    }
}
