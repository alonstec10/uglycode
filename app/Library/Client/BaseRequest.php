<?php

namespace App\Library\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;

abstract class BaseRequest
{
    /**
     * @var string $url
     */
    private string $url;

    /**
     * @var string $query
     */
    private string $query;

    /**
     * @var Client $client
     */
    private Client $client;

    /**
     * @var array $headers
     */
    private array $headers;

    /**
     * @var array $params
     */
    private array $params;

    /**
     * @var string $rawResponse
     */
    private string $rawResponse;

    /**
     * @var string $verb
     */
    private string $verb;

    /**
     * @return string
     */
    public function getVerb(): string
    {
        return $this->verb;
    }

    /**
     * @param string $verb
     */
    public function setVerb(string $verb): void
    {
        $this->verb = $verb;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client): void
    {
        $this->client = $client;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param array $params
     */
    public function setParams(array $params): void
    {
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getRawResponse(): string
    {
        return $this->rawResponse;
    }

    /**
     * @param string $rawResponse
     */
    public function setRawResponse(string $rawResponse): void
    {
        $this->rawResponse = $rawResponse;
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * @param string $query
     */
    public function setQuery(string $query): void
    {
        $this->query = $query;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @param string $url
     * @param string $query
     * @throws \Exception
     */
    public function __construct( string $url, string $query)
    {
        if( empty( $url ) || empty($query) ) {
            throw new \Exception("Need base url and query string to instantiate object");
        }
        $this->setUrl($url);
        $client = new Client([
            'base_uri' => $this->getUrl(),
            'debug' => env('POLYGON_HTTP_CLIENT_DEBUG', false)
        ]);
        $this->setClient($client);
        $this->setQuery($query);
    }

    /**
     * @return Polygon\Client
     * @throws GuzzleException
     */
    public function execute(): BaseRequest
    {
        $response = $this->getClient()->request(
            $this->getVerb(),
            $this->getUrl() . $this->getQuery(),
            [
                RequestOptions::HEADERS => $this->getHeaders(),
                RequestOptions::BODY => json_encode($this->getParams()),
                RequestOptions::ALLOW_REDIRECTS => true,
            ]
        );
        $this->setRawResponse($response->getBody());
        return $this;
    }
}
