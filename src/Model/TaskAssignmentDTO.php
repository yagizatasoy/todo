<?php

namespace App\Model;

class TaskAssignmentDTO
{
    private int $taskId;
    private string $developerName;
    private string $day;
    private int $difficulty;
    private int $duration;
    private int $assignedDuration;
    private string $providerName;

    public function __construct(
        int $taskId,
        string $developerName,
        string $day,
        int $difficulty,
        int $duration,
        int $assignedDuration,
        string $providerName
    ) {
        $this->taskId = $taskId;
        $this->developerName = $developerName;
        $this->day = $day;
        $this->difficulty = $difficulty;
        $this->duration = $duration;
        $this->assignedDuration = $assignedDuration;
        $this->providerName = $providerName;
    }

    public function getTaskId(): int
    {
        return $this->taskId;
    }

    public function getDeveloperName(): string
    {
        return $this->developerName;
    }

    public function getDay(): string
    {
        return $this->day;
    }

    public function getDifficulty(): int
    {
        return $this->difficulty;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function getAssignedDuration(): int
    {
        return $this->assignedDuration;
    }

    public function getProviderName(): string
    {
        return $this->providerName;
    }
}