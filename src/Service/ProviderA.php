<?php

namespace App\Service;

use App\Model\TaskDTO;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ProviderA implements TaskProviderInterface
{
    const NAME = "A";

    const URI = 'https://raw.githubusercontent.com/WEG-Technology/mock/refs/heads/main/mock-one';

    public function __construct(protected HttpClientInterface $client)
    {
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function fetchTasks(): ArrayCollection
    {
        $response = $this->client->request('GET', self::URI);

        $collection = new ArrayCollection();
        if ($response->getStatusCode() == Response::HTTP_OK) {
            $result = json_decode($response->getContent(), true);
            foreach ($result as $row) {
                $collection->add(
                    new TaskDTO(
                        $row['id'],
                        $row['value'],
                        $row['estimated_duration'],
                        self::NAME
                    )
                );
            }
        }

        return $collection;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}