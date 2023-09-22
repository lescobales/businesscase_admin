<?php

namespace App\Entity;

use App\Repository\GetActionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GetActionRepository::class)]
class GetAction
{
	public function __construct(private GetActionRepository $getRepository){

}
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function handle(): Response{
	  return $getRepository->find(1); 
    }
}
