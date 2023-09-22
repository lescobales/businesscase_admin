<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TypeNftRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
#[ApiResource(
    collectionOperations: 
    [
            
    ],
    itemOperations:
    [
        'get' =>
        [
            'normalization_context' => [
                'groups' => 'nftType:item'
            ]
        ]
    ],

)]
#[ORM\Entity(repositoryClass: TypeNftRepository::class)]
class NftType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['nftType:item','nft:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['nftType:item', 'nft:list', 'nft:item'])]
    private ?string $designation = null;

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
}
