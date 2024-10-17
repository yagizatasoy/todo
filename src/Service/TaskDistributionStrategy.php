<?php

namespace App\Service;

interface TaskDistributionStrategy
{
    public function assignTasks(array $tasks, array $developers): array;
}