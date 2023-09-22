<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\NftValueRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations:
    [
            'get' => 
            [
                'normalization_context' => [
                    'groups' => 'nftValue:list'
                ]
            ]
    ],
    itemOperations:
    [
            'get' =>
            [
                'normalization_context' => [
                    'groups' => 'nftValue:item'
                ]
            ]
    ],
    paginationItemsPerPage: 7,
)]

#[ApiFilter(SearchFilter::class, 
	    properties: ['nft.id' => 'exact'])]
#[ApiFilter(OrderFilter::class, 
            properties: ['createdAt' => 'DESC'])]
#[ORM\Entity(repositoryClass: NftValueRepository::class)]
class NftValue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['nftValue:item', 'nftValue:list', 'nft:list'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['nftValue:item', 'nftValue:list', 'nft:list'])]
    private ?float $weight = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['nftValue:item', 'nftValue:list', 'nft:list'])]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'nftValues')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Nft $nft = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): static
    {
        $this->weight = $weight;

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

    public function getNft(): ?Nft
    {
        return $this->nft;
    }

    public function setNft(?Nft $nft): static
    {
        $this->nft = $nft;

        return $this;
    }
}
