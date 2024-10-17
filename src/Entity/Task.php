<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 */
class Task
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $taskId;

    /**
     * @ORM\Column(name="difficulty_multiplier", type="integer")
     */
    private ?int $difficultyMultiplier;

    /**
     * @ORM\Column(type="integer", name="estimated_duration")
     */
    private ?int $estimatedDuration;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private ?string $providerName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTaskId(): ?int
    {
        return $this->taskId;
    }

    public function setTaskId(?int $taskId): void
    {
        $this->taskId = $taskId;
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

    public function getEstimatedDuration(): ?int
    {
        return $this->estimatedDuration;
    }

    public function setEstimatedDuration(int $estimatedDuration): self
    {
        $this->estimatedDuration = $estimatedDuration;

        return $this;
    }

    public function getProviderName(): ?string
    {
        return $this->providerName;
    }

    public function setProviderName(?string $providerName): self
    {
        $this->providerName = $providerName;

        return $this;
    }
}
