<?php

namespace App\Service;

class TaskDistributor
{
    public function __construct(protected TaskDistributionStrategy $strategy) {}

    /**
     * @param array $tasks
     * @param array $developers
     * @return array
     */
    public function distribute(array $tasks, array $developers): array {
        return $this->strategy->assignTasks($tasks, $developers);
    }
}