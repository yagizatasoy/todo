<?php

namespace App\Command;

use App\Service\TaskService;
use App\Service\TaskProviderFactory;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class FetchTasksCommand extends Command
{
    protected static $defaultName = 'fetch-task';
    protected static string $defaultDescription = 'If a specific provider is given as a parameter, 
    it fetches tasks only from that provider; otherwise, 
    it fetches tasks from all available providers.';

    public function __construct(protected TaskProviderFactory $taskProviderFactory, protected  TaskService $taskService)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('provider', InputArgument::OPTIONAL, 'Provider Name');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $providerName = $input->getArgument('provider');

        if (!empty($providerName) &&!is_string($providerName) ) {
            $io->error('Provider name must be a string');
            return 1;
        }

        try {
            if (!empty($providerName)) {
                $provider = $this->taskProviderFactory->getProviderByName($providerName);

                $tasks = $provider->fetchTasks();

                if ($tasks->count() > 0) {
                    $this->taskService->saveTasks($tasks);
                }
            } else {
                $providers = $this->taskProviderFactory->getProviders();

                foreach ($providers as $provider) {
                    $tasks = $provider->fetchTasks();

                    if ($tasks->count() > 0) {
                        $this->taskService->saveTasks($tasks);
                    }
                }
            }
        } catch (Exception $exception) {
            $io->error($exception->getMessage());
            return 1;
        }

        $io->success('All tasks have been fetched');
        return 0;
    }
}
