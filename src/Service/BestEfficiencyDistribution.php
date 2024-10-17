<?php

namespace App\Service;

use App\Model\TaskAssignmentDTO;

class BestEfficiencyDistribution implements TaskDistributionStrategy
{
    /**
     * @param array $tasks
     * @param array $developers
     * @return array
     */
    public function assignTasks(array $tasks, array $developers): array
    {
        $maxDailyHours = 9;
        $assignments = [];
        $day = 1;
        $dailyWorkHours = array_fill(0, count($developers), 0);
        $developerIndex = 0;
        $taskLockedToDeveloper = null;
        $developerMaxDays = array_fill(0, count($developers), 1);

        while (!empty($tasks)) {
            if ($taskLockedToDeveloper === null) {
                $task = array_shift($tasks);
                $taskLockedToDeveloper = $task;
            } else {
                $task = $taskLockedToDeveloper;
            }

            $taskDuration = $task->getEstimatedDuration() * $task->getDifficultyMultiplier();

            while ($taskDuration > 0) {
                $remainingHours = ($maxDailyHours * $developers[$developerIndex]->getDifficultyMultiplier()) - $dailyWorkHours[$developerIndex];

                if ($taskDuration <= $remainingHours) {
                    $assignments[$developers[$developerIndex]->getName()]["Day $day"][] = new TaskAssignmentDTO(
                        $task->getTaskId(),
                        $developers[$developerIndex]->getName(),
                        "Day $day",
                        $task->getDifficultyMultiplier(),
                        $task->getEstimatedDuration(),
                        $taskDuration,
                        $task->getProviderName()
                    );

                    $dailyWorkHours[$developerIndex] += $taskDuration;
                    $taskDuration = 0;
                    $taskLockedToDeveloper = null;
                } else {
                    $assignments[$developers[$developerIndex]->getName()]["Day $day"][] = new TaskAssignmentDTO(
                        $task->getTaskId(),
                        $developers[$developerIndex]->getName(),
                        "Day $day",
                        $task->getDifficultyMultiplier(),
                        $task->getEstimatedDuration(),
                        $remainingHours,
                        $task->getProviderName()
                    );

                    $taskDuration -= $remainingHours;
                    $dailyWorkHours[$developerIndex] = $maxDailyHours;
                }

                if ($dailyWorkHours[$developerIndex] >= $maxDailyHours) {
                    $developerIndex = ($developerIndex + 1) % count($developers);
                    if ($developerIndex == 0) {
                        $day++;
                        $dailyWorkHours = array_fill(0, count($developers), 0);

                        foreach ($developerMaxDays as &$maxDay) {
                            $maxDay = max($maxDay, $day);
                        }
                    }
                }
                $developerMaxDays[$developerIndex] = max($developerMaxDays[$developerIndex], $day);
            }
        }

        $totalDays = max($developerMaxDays);
        return ['assignments' => $assignments, 'totalDays' => $totalDays];
    }
}