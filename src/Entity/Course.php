<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\MongoDbOdm\Filter\OrderFilter;
use App\Repository\CourseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations:
    [
        'get' =>
        [
            'normalization_context' =>
            [
                'groups' => 'course:list'
            ]
        ]
    ],
    itemOperations:
    [
        'get' =>
        [
            'normalization_context' => [
                'groups' => 'course:item'
            ]
        ]
    ],
    paginationItemsPerPage: 7,
)]
#[ApiFilter(OrderFilter::class, 
            properties: ['createdAt' => 'DESC'])]
#[ORM\Entity(repositoryClass: CourseRepository::class)]
class Course
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['course:list', 'course:item'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['course:list', 'course:item'])]
    private ?float $eurCourse = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['course:list', 'course:item'])]
    private ?\DateTimeInterface $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEurCourse(): ?float
    {
        return $this->eurCourse;
    }

    public function setEurCourse(float $eurCourse): static
    {
        $this->eurCourse = $eurCourse;

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
