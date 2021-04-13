<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;
use App\Filter\RecipeSearchFilter;
use App\Repository\RecipeLevelRepository;
use App\Validator as RecipeAssert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource(
 *     collectionOperations={
 *          "get",
 *          "post" = { "security" = "is_granted('CREATE')" },
 *     },
 *     itemOperations={
 *          "get",
 *          "put",
 *          "delete" = { "security" = "is_granted('DELETE', object)" },
 *     },
 *     shortName="recipe_level"
 * )
 * @ApiFilter(PropertyFilter::class)
 * @UniqueEntity(fields={"level"})
 * @ApiFilter(RecipeSearchFilter::class)
 * @ORM\Entity(repositoryClass=RecipeLevelRepository::class)
 * @ORM\EntityListeners({"App\Doctrine\RecipeLevelListener"})
 */
class RecipeLevel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"recipe_level:read", "card:read"})
     */
    private int $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"recipe_level:read", "recipe_level:write", "card:read"})
     */
    private int $level;

    /**
     * @ORM\ManyToMany(targetEntity=Card::class, inversedBy="recipeLevels")
     * @Groups({"recipe_level:read", "recipe_level:write"})
     * @RecipeAssert\MaximumCollectionItem(max="5")
     * @RecipeAssert\MinimumCollectionItem(min="5")
     */
    private Collection $cards;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private ?User $updatedBy;

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
