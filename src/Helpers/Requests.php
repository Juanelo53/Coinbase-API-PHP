<?php
namespace JuaneloCoinbase\Helpers;

use Dotenv\Exception\InvalidFileException;
use JuaneloCoinbase\Helpers\CurlX;

/**
 * Coinbase Class for send Requests with CurlX of author DevBlack.
 * @author Juanelo <juanelo@juanelocode.xyz>
 */

abstract class Requests
{
    private string $baseUrl = 'https://api.commerce.coinbase.com/';

    protected array|object $headers = [];

    protected function setHeaders(#[\SensitiveParameter] array $headers = [])
    {
        $this->headers = $headers;
    }

    private function getHeaders() : array|object
    {
        return $this->headers;
    }

    protected function post(string $endpoint, #[\SensitiveParameter] array|object $params = []) : array|object|string
    {
        return $this->sendRequest(
            method: 'Post',
            endPoint: $endpoint,
            params: $params
        );
    }

    protected function get(string $endpoint) : array|object
    {
        return $this->sendRequest(
            method: 'Get',
            endPoint: $endpoint
        );
    }

    protected function put(string $endpoint, #[\SensitiveParameter] array|object $params = []) : array|object
    {
        return $this->sendRequest(
            method: 'Put',
            endPoint: $endpoint,
            params: $params
        );
    }

    protected function delete(string $endpoint, #[\SensitiveParameter] array|object $params = []) : array|object
    {
        return $this->sendRequest(
            method: 'Delete',
            endPoint: $endpoint,
            params: $params
        );
    }

    private function sendRequest(string $method, string $endPoint, #[\SensitiveParameter] array|object $params = []) : array|object {
        if(!method_exists(CurlX::class, $method)) 
            throw new \InvalidArgumentException("Invalid HTTP method: {$method}");
        
        try {
            $requestParams = [
                'url' => $this->baseUrl . $endPoint,
                'data' => $params,
                'headers' => $this->getHeaders()
            ];

            if($method === 'Get')
                unset($requestParams['data']);

            $request = CurlX::$method(...$requestParams);
        
            return $this->checkError($request);
        } catch (\Exception $e) {
            throw new \InvalidArgumentException("Error in HTTP Request:", $e->getCode(), $e);
        }
    }

    protected function checkError($request) : array|object
    {
        if ( $request->code == 401 )
            throw new \InvalidArgumentException( 'Authentication Failed, Please check your Api Key of Coinbase' );

        return json_decode($request->body);
    }

    protected function debug($params) : void
    {
        var_dump( $params );
    }

}
