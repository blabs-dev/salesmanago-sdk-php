<?php

namespace Blabs\SalesManago\Exceptions;

use Exception;
use GuzzleHttp\Psr7\Response as Response;

class InvalidRequestException extends Exception
{
    /**
     * @var string
     */
    protected string $requestUrl;

    /**
     * @var array
     */
    protected array $requestData;

    /**
     * @var Response
     */
    protected Response $response;

    /**
     * Extended Exception constructor.
     *
     * @param string   $requestUrl  Request URL
     * @param array    $requestData Request data
     * @param Response $response    Response
     */
    public function __construct($requestUrl, array $requestData, Response $response)
    {
        $this->requestUrl = $requestUrl;
        $this->requestData = $requestData;
        $this->response = $response;
        $this->message = 'Error occurred when sending request.';

        parent::__construct($this->message, 0, null);
    }

    /**
     * Returning request url.
     *
     * @return string
     */
    public function getRequestUrl()
    {
        return $this->requestUrl;
    }

    /**
     * Returning request data.
     *
     * @return array
     */
    public function getRequestData()
    {
        return $this->requestData;
    }

    /**
     * Returning response.
     *
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }
}
