<?php

namespace App\Entity;

use App\Repository\DeveloperRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DeveloperRepository::class)
 */
class Developer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=150)
     */
    private ?string $name;

    /**
     * @ORM\Column(name="difficulty_multiplier", type="integer")
     */
    private ?int $difficultyMultiplier;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDifficultyMultiplier(): ?int
    {
        return $this->difficultyMultiplier;
    }

    public function setDifficultyMultiplier(?int $difficultyMultiplier): self
    {
        $this->difficultyMultiplier = $difficultyMultiplier;

        return $this;
    }
}
