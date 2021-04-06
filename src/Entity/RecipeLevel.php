<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;
use App\Repository\RecipeLevelRepository;
use App\Validator as RecipeAssert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={
 *          "get"={},
 *          "put"
 *     },
 *     normalizationContext={"groups"={"recipelevel:read"}, "swagger_definition_name"="Read"},
 *     denormalizationContext={"groups"={"recipelevel:write"}},
 *     shortName="recipe_levels"
 * )
 * @ORM\Entity(repositoryClass=RecipeLevelRepository::class)
 * @ApiFilter(PropertyFilter::class)
 * @UniqueEntity(fields={"level"})
 */
class RecipeLevel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"recipelevel:read", "card:read"})
     */
    private int $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"recipelevel:read", "card:read"})
     */
    private int $level;

    /**
     * @ORM\ManyToMany(targetEntity=Card::class, inversedBy="recipeLevels")
     * @Groups({"recipelevel:read", "recipelevel:write"})
     * @RecipeAssert\MaximumCollectionItem(max="5")
     * @RecipeAssert\MinimumCollectionItem(min="5")
     */
    private Collection $cards;

    public function __construct()
    {
        $this->cards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Card[]
     */
    public function getCards(): Collection
    {
        return $this->cards;
    }

    public function addCard(Card $card): self
    {
        if (!$this->cards->contains($card)) {
            $this->cards[] = $card;
        }

        return $this;
    }

    public function removeCard(Card $card): self
    {
        $this->cards->removeElement($card);

        return $this;
    }
}
