<?php

namespace App\Service;

use Doctrine\Common\Collections\ArrayCollection;

interface TaskProviderInterface
{
    public function getName(): string;
    public function fetchTasks(): ArrayCollection;
}