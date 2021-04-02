<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;
use App\Repository\RecipeRepository;
use App\Validator as RecipeAssert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     collectionOperations={"get", "post"},
 *     itemOperations={
 *          "get"={},
 *          "put"
 *     },
 *     normalizationContext={"groups"={"recipe:read"}, "swagger_definition_name"="Read"},
 *     denormalizationContext={"groups"={"recipe:write"}},
 *     shortName="recipes"
 * )
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 * @ApiFilter(PropertyFilter::class)
 */
class Recipe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"recipe:read", "card:read", "item:read"})
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity=Item::class, inversedBy="recipes")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"recipe:read", "recipe:write", "card:read"})
     */
    private Item $item;

    /**
     * @ORM\ManyToMany(targetEntity=Card::class, inversedBy="recipes", cascade={"persist"})
     * @Groups({"recipe:read", "recipe:write", "item:read"})
     * @Assert\Valid()
     * @RecipeAssert\MaximumCollectionItem(max="5")
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

    public function getItem(): ?Item
    {
        return $this->item;
    }

    public function setItem(?Item $item): self
    {
        $this->item = $item;

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
