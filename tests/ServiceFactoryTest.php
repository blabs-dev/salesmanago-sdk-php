<?php

namespace Blabs\SalesManago\Test;

use Blabs\SalesManago\Configurator;
use Blabs\SalesManago\ServiceFactory;
use Blabs\SalesManago\Services\ApiService;
use PHPUnit\Framework\TestCase;

class ServiceFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_create_contact_service()
    {
        $configurator = new Configurator('test-client-id', 'test-api-secret');
        $factory = new ServiceFactory($configurator);
        $service = $factory->createContactService();
        $this->assertEquals(ApiService::class, get_class($service));
    }
}
