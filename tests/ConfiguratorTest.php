<?php

namespace Blabs\SalesManago\Test;

use Blabs\SalesManago\Configurator;
use PHPUnit\Framework\TestCase;

class ConfiguratorTest extends TestCase
{
    private string $testClientId;
    private string $testApiKey;
    private string $testApiSecret;

    /**
     * @test
     */
    public function it_can_generate_configuration_data_properly()
    {
        $configurator = new Configurator(
            $this->testClientId,
            $this->testApiSecret,
            $this->testApiKey,
        );

        $this->assertEquals(
            sha1($this->testApiKey.$this->testClientId.$this->testApiSecret),
            $configurator->getSha()
        );
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->testClientId = 'test-client-id';
        $this->testApiKey = 'test-api-key';
        $this->testApiSecret = 'test-api-secret';
    }
}
