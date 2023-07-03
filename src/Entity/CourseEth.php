<?php

namespace App\Entity;

use App\Repository\CourseEthRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseEthRepository::class)]
class CourseEth
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $courseEur = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCourse = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCourseEur(): ?float
    {
        return $this->courseEur;
    }

    public function setCourseEur(float $courseEur): static
    {
        $this->courseEur = $courseEur;

        return $this;
    }

    public function getDateCourse(): ?\DateTimeInterface
    {
        return $this->dateCourse;
    }

    public function setDateCourse(\DateTimeInterface $dateCourse): static
    {
        $this->dateCourse = $dateCourse;

        return $this;
    }
}
