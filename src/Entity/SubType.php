<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\SubTypeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={
 *          "get"
 *     },
 *     shortName="sub_type",
 *     attributes={
 *          "pagination_enabled"=false
 *     }
 * )
 * @ApiFilter(SearchFilter::class, properties={
 *     "name": "ipartial",
 *     "type.id": "exact",
 * })
 * @ORM\Entity(repositoryClass=SubTypeRepository::class)
 */
class SubType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"sub_type:read", "item:read", "card:read", "type:read"})
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class, inversedBy="subTypes")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"sub_type:read", "item:read", "card:read"})
     */
    private Type $type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"sub_type:read", "item:read", "card:read", "type:read"})
     */
    private string $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

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
}
