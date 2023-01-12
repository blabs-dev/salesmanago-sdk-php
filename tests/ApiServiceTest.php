<?php

namespace Blabs\SalesManago\Test;

use Blabs\SalesManago\Configurator;
use Blabs\SalesManago\DataTransferObjects\DataModels\ContactInfoData;
use Blabs\SalesManago\ServiceFactory;
use Blabs\SalesManago\Services\ApiService;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class ApiServiceTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_upsert_customer()
    {
        $responseMock = new Response(200, [], '{
            "success": true,
            "message": [],
            "contactId": "ded47013-4867-42f7-83fa-57ddc651f4a6",
            "externalId": "U123456"
        }');
        $service = $this->mockApiService([$responseMock]);

        $attributes = json_decode('{
          "owner": "test@test.org",
          "contact": {
            "email": "name@example.com",
            "phone": "+15554443322",
            "name": "John Doe",
            "externalId": "U123456",
            "address": {
              "streetAddress": "Main Street 21",
              "zipCode": "90210",
              "city": "San José",
              "country": "US"
            }
          },
          "province": "California",
          "birthday": "19870605",
          "properties": {
            "circuito": "Italia va In rete"
          },
          "forceOptIn": true,
          "forceOptOut": false,
          "forcePhoneOptIn": false,
          "forcePhoneOptOut": true
         }', true);

        $responseData = $service->upsertContact($attributes);
        $this->assertEquals('ded47013-4867-42f7-83fa-57ddc651f4a6', $responseData->contactId);
        $this->assertEquals('U123456', $responseData->externalId);
    }

    /**
     * @test
     */
    public function it_can_add_external_events()
    {
        $responseMock = new Response(200, [], '{
            "success": true,
            "message": [],
            "eventId": "3521dc0f-a934-4b6c-bb08-84f2e144047d"
        }');

        $service = $this->mockApiService([$responseMock]);

        $attributes = json_decode(
            '{
            "owner": "test@test.org",
            "email":"name@example.com",
                "contactEvent":{
                    "date":1356180568153,
                    "description":"Purchase card \"Super Bonus\"",
                    "products":"p01, p02",
                    "location":"Shop_ID",
                    "value":1234.43,
                    "contactExtEventType":"PURCHASE",
                    "detail1":"C.ID: *** *** 234",
                    "detail2":"Payment by credit card",
                    "detail3":null,
                    "externalId":"A-123123123",
                    "shopDomain":"shop.salesmanago.pl"
                }
             }',
            true
        );

        $responseData = $service->addExternalEvent($attributes);
        $this->assertEquals('3521dc0f-a934-4b6c-bb08-84f2e144047d', $responseData->eventId);
    }

    /**
     * @test
     */
    public function it_can_show_contact_info()
    {
        $responseMock = new Response(200, [], '{
            "success": true,
            "message": [],
            "contacts": [
                {
                    "name": "Banan",
                    "email": "test@mail.com",
                    "phone": "+393331231234",
                    "fax": null,
                    "score": 90,
                    "state": "PROSPECT",
                    "optedOut": false,
                    "optedOutPhone": false,
                    "deleted": false,
                    "invalid": false,
                    "company": null,
                    "externalId": "152631",
                    "address": null,
                    "contactId": "017ba22b-85ca-11ed-9d06-40a6b73c97e4",
                    "birthdayYear": "1984",
                    "birthdayMonth": "8",
                    "birthdayDay": "4",
                    "modifiedOn": 1672327453000,
                    "createdOn": 1672133817000,
                    "lastVisit": null
                }
            ]
        }');

        $service = $this->mockApiService([$responseMock]);

        $contacts_info = $service->contactInfo(['test@mail.com'], 'test@owners.com');

        $this->assertIsArray($contacts_info);
        $this->assertCount(1, $contacts_info);
        $item = $contacts_info[0];
        $this->assertEquals(ContactInfoData::class, get_class($item));
    }

    private function mockHttpClient(array $responses): Client
    {
        // Create a mock and queue two responses.
        $mock = new MockHandler($responses);

        $handlerStack = HandlerStack::create($mock);

        return new Client(['handler' => $handlerStack]);
    }

    public function mockApiService(array $responses): ApiService
    {
        $client = $this->mockHttpClient($responses);
        $configurator = new Configurator('test-id', 'test-secret');
        $factory = new ServiceFactory($configurator, $client);

        return $factory->createContactService();
    }
}
