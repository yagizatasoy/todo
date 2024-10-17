<?php

use App\Service\TaskProviderFactory;
use App\Service\TaskProviderInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProviderTest extends KernelTestCase
{
    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testGetProvidersReturnsAllProviders()
    {
        $providerA = $this->createMockProvider('A');
        $providerB = $this->createMockProvider('B');

        $factory = new TaskProviderFactory(new \ArrayIterator([$providerA, $providerB]));

        $providers = $factory->getProviders();
        $this->assertCount(2, $providers);
    }

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testGetProviderByNameReturnsCorrectProvider()
    {
        $provider = $this->createMockProvider('B');

        $factory = new TaskProviderFactory(new \ArrayIterator([$provider]));

        $result = $factory->getProviderByName('B');
        $this->assertSame($provider, $result);
    }

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testGetProviderByNameThrowsExceptionForUnknownProvider()
    {
        $this->expectException(\InvalidArgumentException::class);

        $provider = $this->createMockProvider('A');

        $factory = new TaskProviderFactory(new \ArrayIterator([$provider]));
        $factory->getProviderByName('UnknownProvider');
    }

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    private function createMockProvider(string $name): TaskProviderInterface
    {
        $mock = $this->createMock(TaskProviderInterface::class);
        $mock->method('getName')->willReturn($name);
        return $mock;
    }
}