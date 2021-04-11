<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CardTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"},
 *     shortName="card_type"
 * )
 * @ORM\Entity(repositoryClass=CardTypeRepository::class)
 */
class CardType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"card_type:read", "card:read", "card:write", "item:read", "recipe:read", "recipe_level:read"})
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"card_type:read", "card:read", "card:write", "item:read", "recipe:read", "recipe_level:read"})
     */
    private string $name;

    /**
     * @ORM\OneToMany(targetEntity=Card::class, mappedBy="type")
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
            $card->setType($this);
        }

        return $this;
    }

    public function removeCard(Card $card): self
    {
        if ($this->cards->removeElement($card)) {
            // set the owning side to null (unless already changed)
            if ($card->getType() === $this) {
                $card->setType(null);
            }
        }

        return $this;
    }
}
