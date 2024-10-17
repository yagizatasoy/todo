<?php

namespace App\Service;

use InvalidArgumentException;

class TaskProviderFactory
{
    private \Traversable $providers;

    public function __construct(\Traversable $providers)
    {
        $this->providers = $providers;
    }

    /**
     * @return TaskProviderInterface[]
     */
    public function getProviders(): array
    {
        return iterator_to_array($this->providers);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function getProviderByName(string $name): TaskProviderInterface
    {
        foreach ($this->providers as $provider) {
            if ($provider->getName() === $name) {
                return $provider;
            }
        }

        throw new InvalidArgumentException(sprintf('Provider "%s" not found.', $name));
    }
}