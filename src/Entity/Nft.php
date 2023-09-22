<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\NftRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiFilter;
#[ORM\Entity(repositoryClass: NftRepository::class)]
#[ApiResource(
        collectionOperations:
        [
            'get' => 
            [
                'normalization_context' => [
                    'groups' => 'nft:list'
                ],

            ],
            'post' => 
            [
                'denormalization_context' => [
                    'groups' => 'nft:post'
                ]
            ],
        ],
        itemOperations:
        [
            'get' =>
            [
                'normalization_context' => [
                    'groups' => 'nft:item'
                ],
            ],
            'put',
            'delete'
        ],
        paginationItemsPerPage: 10,
)]

#[ApiFilter(SearchFilter::class, properties:['owner.pseudo' => 'exact'])]
class Nft
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['nft:item', 'nft:list'])]
    private ?int $id = null;

    #[ORM\Column(length: 1000)]
    #[Groups(['nft:item', 'nft:list'])] 
    private ?string $token = null;

    #[ORM\Column(length: 255)]
    #[Groups(['nft:item', 'nft:list'])] 
    private ?string $title = null;

    #[ORM\Column]
    #[Groups(['nft:item', 'nft:list'])] 
    private ?float $initialPrice = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['nft:item', 'nft:list'])] 
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['nft:item', 'nft:list'])] 
    private ?NftType $nftType = null;

    #[ORM\OneToMany(mappedBy: 'nft', targetEntity: NftValue::class, orphanRemoval: true)]
    #[Groups(['nft:item', 'nft:list'])] 
    private Collection $nftValues;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['nft:item', 'nft:list'])] 
    private ?Category $category = null;

    #[ORM\OneToMany(mappedBy: 'nft', targetEntity: Visit::class, orphanRemoval: true)]
    #[Groups(['nft:item'])]
    private Collection $visits;

    #[ORM\ManyToOne(inversedBy: 'nfts')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['nft:item'])]
    private ?User $owner = null;

    #[ORM\ManyToMany(targetEntity: PreOrder::class, mappedBy: 'nfts')]
    #[Groups('nft:item')]
    private Collection $preOrders;

    #[ORM\ManyToOne(inversedBy: 'nfts')]
    #[Groups(['nft:item'])]
    private ?NftCollection $nftCollection = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['nft:item', 'nft:list'])]
    private ?string $representation = null;

    public function __construct()
    {
        $this->nftValues = new ArrayCollection();
        $this->visits = new ArrayCollection();
        $this->preOrders = new ArrayCollection();
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

    public function getInitialPrice(): ?float
    {
        return $this->initialPrice;
    }

    public function setInitialPrice(float $initialPrice): static
    {
        $this->initialPrice = $initialPrice;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getNftType(): ?NftType
    {
        return $this->nftType;
    }

    public function setNftType(?NftType $nftType): static
    {
        $this->nftType = $nftType;

        return $this;
    }

    /**
     * @return Collection<int, NftValue>
     */
    public function getNftValues(): Collection
    {
        return $this->nftValues;
    }

    public function addNftValue(NftValue $nftValue): static
    {
        if (!$this->nftValues->contains($nftValue)) {
            $this->nftValues->add($nftValue);
            $nftValue->setNft($this);
        }

        return $this;
    }

    public function removeNftValue(NftValue $nftValue): static
    {
        if ($this->nftValues->removeElement($nftValue)) {
            // set the owning side to null (unless already changed)
            if ($nftValue->getNft() === $this) {
                $nftValue->setNft(null);
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

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection<int, PreOrder>
     */
    public function getPreOrders(): Collection
    {
        return $this->preOrders;
    }

    public function addPreOrder(PreOrder $preOrder): static
    {
        if (!$this->preOrders->contains($preOrder)) {
            $this->preOrders->add($preOrder);
            $preOrder->addNft($this);
        }

        return $this;
    }

    public function removePreOrder(PreOrder $preOrder): static
    {
        if ($this->preOrders->removeElement($preOrder)) {
            $preOrder->removeNft($this);
        }

        return $this;
    }

    public function getNftCollection(): ?NftCollection
    {
        return $this->nftCollection;
    }

    public function setNftCollection(?NftCollection $nftCollection): static
    {
        $this->nftCollection = $nftCollection;

        return $this;
    }

    public function getRepresentation(): ?string
    {
        return $this->representation;
    }

    public function setRepresentation(?string $representation): static
    {
        $this->representation = $representation;

        return $this;
    }
}
