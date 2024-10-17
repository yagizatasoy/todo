<?php

namespace App\Service;
use App\Entity\Task;
use App\Model\TaskDTO;
use App\Repository\DeveloperRepository;
use App\Repository\TaskRepository;
use Doctrine\Common\Collections\ArrayCollection;

class TaskService
{
    private TaskRepository $taskRepository;
    private DeveloperRepository $developerRepository;

    public function __construct(
        TaskRepository $taskRepository,
        DeveloperRepository $developerRepository
    )
    {
        $this->taskRepository = $taskRepository;
        $this->developerRepository = $developerRepository;
    }

    /**
     * @param ArrayCollection $tasks
     * @return void
     */
    public function saveTasks(ArrayCollection $tasks): void
    {
        foreach ($tasks as $task) {
            if ($task instanceof TaskDTO) {
                $isExist = $this->taskRepository->findOneBy(
                    [
                        'taskId' => $task->getId(),
                        'providerName' => $task->getName()
                    ]
                );

                if ($isExist) {
                    continue;
                }

                $taskEntity = new Task();
                $taskEntity->setTaskId($task->getId());
                $taskEntity->setDifficultyMultiplier($task->getDifficulty());
                $taskEntity->setEstimatedDuration($task->getDuration());
                $taskEntity->setProviderName($task->getName());

                $this->taskRepository->add($taskEntity);
            }
        }
    }

    public function distributeTasks(): array
    {
        $tasks = $this->taskRepository->findBy([], ['difficultyMultiplier' => 'DESC']);
        $developers = $this->developerRepository->findBy([], ['difficultyMultiplier' => 'DESC']);

        $taskDistributor = new TaskDistributor(new BestEfficiencyDistribution());
        return $taskDistributor->distribute($tasks, $developers);
    }
}