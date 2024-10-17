<?php

namespace App\Controller;

use App\Service\TaskService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    public function __construct(protected TaskService $taskService) {}

    /**
     * @Route("/tasks", name="show_distributed_tasks")
     */
    public function index(): Response
    {
        return $this->render('task/index.html.twig', $this->taskService->distributeTasks());
    }
}
