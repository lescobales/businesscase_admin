<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\NftRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: NftRepository::class)]
#[ApiResource(
    collectionOperations:[
        'post' => [
            'denormalization_context' => [
                'groups' => 'nfts:post'
            ]
            ],
        'get' => [
            'normalization_context' => [
                'groups' => 'ntfs:list'
            ]
        ]
    ],
    itemOperations:[
        'get',
        'put',
        'delete'
    ]

)]
class Nft
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $token = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $representation = null;

    #[ORM\Column]
    private ?float $initialPrice = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantity = null;

    #[ORM\OneToMany(mappedBy: 'nft', targetEntity: Item::class)]
    private Collection $items;

    #[ORM\ManyToOne(inversedBy: 'nfts')]
    private ?TypeNft $typeNft = null;

    #[ORM\OneToMany(mappedBy: 'nft', targetEntity: Value::class)]
    private Collection $values;

    #[ORM\ManyToOne(inversedBy: 'nfts')]
    private ?Category $category = null;

    #[ORM\OneToMany(mappedBy: 'nft', targetEntity: Visit::class)]
    private Collection $visits;

    #[ORM\ManyToOne(inversedBy: 'nfts')]
    private ?User $user = null;

    public function __construct()
    {
        $this->items = new ArrayCollection();
        $this->values = new ArrayCollection();
        $this->visits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): static
    {
        $this->token = $token;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getRepresentation(): ?string
    {
        return $this->representation;
    }

    public function setRepresentation(string $representation): static
    {
        $this->representation = $representation;

        return $this;
    }

    public function getInitialPrice(): ?float
    {
        return $this->initialPrice;
    }

    public function setInitialPrice(float $initialPrice): static
    {
        $this->initialPrice = $initialPrice;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return Collection<int, Item>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): static
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
            $item->setNft($this);
        }

        return $this;
    }

    public function removeItem(Item $item): static
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getNft() === $this) {
                $item->setNft(null);
            }
        }

        return $this;
    }

    public function getTypeNft(): ?TypeNft
    {
        return $this->typeNft;
    }

    public function setTypeNft(?TypeNft $typeNft): static
    {
        $this->typeNft = $typeNft;

        return $this;
    }

    /**
     * @return Collection<int, Value>
     */
    public function getValue(): Collection
    {
        return $this->values;
    }

    public function addValue(Value $value): static
    {
        if (!$this->values->contains($value)) {
            $this->values->add($value);
            $value->setNft($this);
        }

        return $this;
    }

    public function removeValue(Value $value): static
    {
        if ($this->values->removeElement($value)) {
            // set the owning side to null (unless already changed)
            if ($value->getNft() === $this) {
                $value->setNft(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Visit>
     */
    public function getVisits(): Collection
    {
        return $this->visits;
    }

    public function addVisit(Visit $visit): static
    {
        if (!$this->visits->contains($visit)) {
            $this->visits->add($visit);
            $visit->setNft($this);
        }

        return $this;
    }

    public function removeVisit(Visit $visit): static
    {
        if ($this->visits->removeElement($visit)) {
            // set the owning side to null (unless already changed)
            if ($visit->getNft() === $this) {
                $visit->setNft(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
