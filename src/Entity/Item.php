<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;
use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     collectionOperations={"get", "post"},
 *     itemOperations={
 *          "get"={
 *              "normalization_context"={"groups"={"item:read", "item:item:get"}}
 *     },
 *          "put"
 *     },
 *     normalizationContext={"groups"={"item:read"}, "swagger_definition_name"="Read"},
 *     denormalizationContext={"groups"={"item:write"}},
 *     shortName="items",
 *     attributes={
 *          "pagination_items_per_page"=30,
 *          "formats"={"jsonld", "html", "json", "jsonhal", "csv"={"text/csv"}}
 *     }
 * )
 * @ORM\Entity(repositoryClass=ItemRepository::class)
 * @ApiFilter(SearchFilter::class, properties={
 *     "name": "ipartial",
 *     "level": "exact",
 *     "recipes.cards.name": "ipartial",
 *     "subType.type.id": "exact",
 *     "subType.id": "exact",
 *     "recipes.cards.id": "exact"
 * })
 * @ApiFilter(RangeFilter::class, properties={"level"})
 * @ApiFilter(PropertyFilter::class)
 */
class Item
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"item:read", "card:read"})
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"item:read", "item:write", "card:read", "recipe:read"})
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min=2,
     *     max=50,
     *     maxMessage="Name must have a 50 chars max length"
     * )
     */
    private string $name;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"item:read", "item:write", "card:read", "recipe:read"})
     * @Assert\NotBlank
     * @Assert\GreaterThan(0)
     */
    private int $level;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"item:read", "item:write", "card:read", "recipe:read"})
     */
    private ?string $link;

    /**
     * @ORM\ManyToOne(targetEntity=SubType::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"item:read", "item:write", "card:read", "recipe:read"})
     */
    private SubType $subType;

    /**
     * @ORM\OneToMany(targetEntity=Recipe::class, mappedBy="item")
     * @Groups({"item:read"})
     */
    private Collection $recipes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $imgLink;

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

    public function getImgLink(): ?string
    {
        return $this->imgLink;
    }

    public function setImgLink(?string $imgLink): self
    {
        $this->imgLink = $imgLink;

        return $this;
    }
}
