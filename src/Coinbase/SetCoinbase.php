<?php
namespace JuaneloCoinbase\Coinbase;

use Dotenv\Dotenv;
use JuaneloCoinbase\Helpers\Requests;

/**
 * @author Juanelo <juanelo@juanelocode.xyz>
 */

abstract class SetCoinbase extends Requests
{
    private string $apiKey;

    public function __construct()
    {
        Dotenv::createUnsafeImmutable( __DIR__.'/../../' )->load();
        $this->apiKey = getenv( 'COINBASE_API_KEY' );

        if ( empty( $this->apiKey ) )
            throw new \InvalidArgumentException( 'Api Key is required!' );

        $this->setHeaders( [
            'Content-Type: application/json',
            'Accept: application/json',
            'X-CC-Version: 2018-03-22',
            'X-CC-Api-Key: ' . $this->apiKey
        ] );
    }

    /**
     * Validate parameters of array.
     * 
     * This class takes the array of parameters to validate as its first option ($params), and ($requiredFields) will take the name of the associative array it will validate by name or subindex.
     *
     * @param array $params
     * @param array $requiredFields
     * @return void
     */
    protected function validateParameters(array $params = [], array $requiredFields = [])
    {
        foreach ( $requiredFields as $field ) {
            $keys = explode( '.', $field );
            $temp = $params;
            foreach ( $keys as $key ) {
                if ( !isset( $temp[$key] ) || empty( $temp[$key] ) ) {
                    throw new \InvalidArgumentException( "The parameter {$field}
                     is required!!" );
                }
                $temp = $temp[$key];
            }
        }
    }
}