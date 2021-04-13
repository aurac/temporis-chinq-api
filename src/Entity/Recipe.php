<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;
use App\Filter\RecipeSearchFilter;
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
 *          "get",
 *          "put",
 *          "delete" = { "security" = "is_granted('DELETE', object)" },
 *     },
 *     shortName="recipe"
 * )
 * @ApiFilter(PropertyFilter::class)
 * @ApiFilter(RecipeSearchFilter::class)
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 * @ORM\EntityListeners({"App\Doctrine\RecipeListener"})
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
     * @Assert\NotBlank
     */
    private ?Item $item;

    /**
     * @ORM\ManyToMany(targetEntity=Card::class, inversedBy="recipes")
     * @Groups({"recipe:read", "recipe:write", "item:read"})
     * @Assert\Valid()
     * @RecipeAssert\MaximumCollectionItem(max="5")
     * @RecipeAssert\MinimumCollectionItem(min="5")
     */
    private Collection $cards;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="recipes")
     * @Groups({"recipe:read"})
     */
    private ?User $createdBy = null;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @Groups({"recipe:read"})
     */
    private ?User $updatedBy = null;

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

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getUpdatedBy(): ?User
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?User $updatedBy): self
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }
}
