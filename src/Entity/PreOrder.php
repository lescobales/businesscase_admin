<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PreOrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations:
    [
        'get' =>
        [
            'normalization_context' => [
                'groups' => 'preOrder:list'
            ]
        ],
        'post' =>
        [
            'denormalization_context' => [
                'groups' => 'preOrder:post'
            ]
        ]
    ],
    itemOperations:
    [
        'get' =>
        [
            'normalization_context' =>
            [
                'groups' => 'preOrder:item'
            ]
        ]
    ]
)]
#[ORM\Entity(repositoryClass: PreOrderRepository::class)]
class PreOrder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['preOrder:item', 'preOrder:list', 'user:item'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'preOrders')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['preOrder:item'])]
    private ?User $asker = null;

    #[ORM\ManyToMany(targetEntity: Nft::class, inversedBy: 'preOrders')]
    #[Groups(['preOrder:item'])]
    private Collection $nfts;

    #[ORM\Column]
    #[Groups(['preOrder:item', 'preOrder:list', 'user:item'])]
    private ?int $amount = null;

    #[ORM\Column]
    #[Groups(['preOrder:item', 'user:item'])]
    private ?bool $isPurchase = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['preOrder:item', 'preOrder:list', 'user:item'])]
    private ?\DateTimeInterface $purchaseAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['preOrder:item', 'preOrder:list', 'user:item'])]
    private ?\DateTimeInterface $createdAt = null;


    public function __construct()
    {
        $this->nfts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAsker(): ?User
    {
        return $this->asker;
    }

    public function setAsker(?User $asker): static
    {
        $this->asker = $asker;

        return $this;
    }

    /**
     * @return Collection<int, Nft>
     */
    public function getNfts(): Collection
    {
        return $this->nfts;
    }

    public function addNft(Nft $nft): static
    {
        if (!$this->nfts->contains($nft)) {
            $this->nfts->add($nft);
        }

        return $this;
    }

    public function removeNft(Nft $nft): static
    {
        $this->nfts->removeElement($nft);

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function isIsPurchase(): ?bool
    {
        return $this->isPurchase;
    }

    public function setIsPurchase(bool $isPurchase): static
    {
        $this->isPurchase = $isPurchase;

        return $this;
    }

    public function getPurchaseAt(): ?\DateTimeInterface
    {
        return $this->purchaseAt;
    }

    public function setPurchaseAt(?\DateTimeInterface $purchaseAt): static
    {
        $this->purchaseAt = $purchaseAt;

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
}
