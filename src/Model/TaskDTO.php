<?php

namespace App\Model;

class TaskDTO
{
    public function __construct(
        protected int    $id,
        protected int    $difficulty,
        protected int    $duration,
        protected string $name
    )
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDifficulty(): int
    {
        return $this->difficulty;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function getName(): string
    {
        return $this->name;
    }
}