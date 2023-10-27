<?php
namespace JuaneloCoinbase\Coinbase\Checkouts;

use JuaneloCoinbase\Coinbase\SetCoinbase;

/**
 * Coinbase Class for Checkouts methods.
 * @author Juanelo <juanelo@juanelocode.xyz>
 */

class CoinbaseCheckouts extends SetCoinbase
{

    private array $requiredParamsForCreateCheckout = [
        'name',
        'description',
        'requested_info',
        'pricing_type',
        'local_price.amount',
        'local_price.currency'
    ];

    private array $requiredParamsForUpdateCheckout = [
        'name',
        'description',
        'local_price.amount',
        'local_price.currency',
    ];

    /**
     * Get all Checkouts orders what create any time and return all checkouts.
     *
     * @return array|object
     */
    public function listAllCheckouts() : array|object
    {
        return $this->get( endpoint: 'checkouts' );
    }

    /**
     * Create a Checkout Order. Required the params for create the Checkot order.
     * 
     * Please read more in: https://docs.cloud.coinbase.com/commerce/reference/createcheckout
     *
     * @param array $params
     * @return array|object
     */
    public function createCheckout(array $params = []) : array|object
    {
        $this->validateParameters(
            params: $params,
            requiredFields: $this->requiredParamsForCreateCheckout
        );
        return $this->post(
            endpoint: 'checkouts',
            params: $params
        );
    }

    /**
     * Show Checkout Order. Required the Checkout ID of the order.
     * 
     * Please read more in: https://docs.cloud.coinbase.com/commerce/reference/getcheckout
     *
     * @param string|integer $checkoutId
     * @return array|object
     */
    public function showCheckout(string|int $checkoutId) : array|object
    {
        return $this->get( endpoint: "chechouts/{$checkoutId}" );
    }

    /**
     * Update a Checkout. Required the Checkout ID and paramas of the update.
     * 
     * Please read more in: https://docs.cloud.coinbase.com/commerce/reference/updatecheckout
     *
     * @param string|integer $checkoutId
     * @param array $params
     * @return array|object
     */
    public function updateCheckout(string|int $checkoutId, array $params = []) : array|object
    {
        $this->validateParameters(
            params: $params,
            requiredFields: $this->requiredParamsForUpdateCheckout
        );
        return $this->put(
            endpoint: "checkouts/{$checkoutId}",
            params: $params
        );
    }

    /**
     * Delete a Checkout Order.
     * 
     * Required a Checkout ID.
     * 
     * Please read more in: https://docs.cloud.coinbase.com/commerce/reference/deletecheckout
     *
     * @param string|integer $checkoutId
     * @return array|object
     */
    public function deleteCheckout(string|int $checkoutId) : array|object
    {
        return $this->delete( endpoint: "checkouts/{$checkoutId}" );
    }
}