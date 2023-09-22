<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\VisitRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations:
    [
            'get' =>
            [
                'normalization_context' => [
                    'groups' => 'visit:list'
                ]
            ],
            'post' =>
            [
                'denormalization_context' => [
                    'groups' => 'visit:post'
                ]
            ]
    ],
    itemOperations:['get'],
)]
#[ORM\Entity(repositoryClass: VisitRepository::class)]
class Visit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['visit:list', 'visit:post', 'user:item'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['visit:list', 'visit:post', 'user:item'])]
    private ?\DateTimeInterface $visitDate = null;

    #[ORM\ManyToOne(inversedBy: 'visits')]
    #[Groups(['visit:list', 'visit:post'])]
    private ?Nft $nft = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVisitDate(): ?\DateTimeInterface
    {
        return $this->visitDate;
    }

    public function setVisitDate(\DateTimeInterface $visitDate): static
    {
        $this->visitDate = $visitDate;

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
