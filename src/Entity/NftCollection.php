<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\NftCollectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiFilter;

#[ApiResource(
    collectionOperations:
    [
        'get' =>
        [
            'normalization_context' => [
                'groups' => 'nftCollection:list'
            ]
        ],
        'post' =>
        [
            'denormalization_context' => [
                'groups' => 'nftCollection:post'
            ]
        ]
    ],
    itemOperations:
    [
            'get' =>
            [
                'normalization_context' =>
                [
                    'groups' => 'nftCollection:item'
                ]
            ],
                'put',
                'delete',
    ]
)]
#[ApiFilter(SearchFilter::class, properties:['nfts.id' => 'exact'])]
#[ORM\Entity(repositoryClass: NftCollectionRepository::class)]
class NftCollection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['nftCollection:item', 'nftCollection:list'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['nftCollection:item', 'nftCollection:list', 'nftCollection:post'])]
    private ?string $designation = null;

    #[ORM\OneToMany(mappedBy: 'nftCollection', targetEntity: Nft::class)]
    #[Groups(['nftCollection:item', 'nftCollection:list', 'nftCollection:post'])]
    private Collection $nfts;

    public function __construct()
    {
        $this->nfts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): static
    {
        $this->designation = $designation;

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
            $nft->setNftCollection($this);
        }

        return $this;
    }

    public function removeNft(Nft $nft): static
    {
        if ($this->nfts->removeElement($nft)) {
            // set the owning side to null (unless already changed)
            if ($nft->getNftCollection() === $this) {
                $nft->setNftCollection(null);
            }
        }

        return $this;
    }
}
