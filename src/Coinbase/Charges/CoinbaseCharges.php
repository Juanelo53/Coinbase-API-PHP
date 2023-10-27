<?php
namespace JuaneloCoinbase\Coinbase\Charges;

use JuaneloCoinbase\Coinbase\SetCoinbase;

/**
 * Coinbase Class for Charges methods.
 * @author Juanelo <juanelo@juanelocode.xyz>
 */

class CoinbaseCharges extends SetCoinbase
{

    private array $requiredParamsForCreateCharge = [
        'name',
        'description',
        'pricing_type',
        'local_price.amount',
        'local_price.currency',
        'metadata.customer_id',
        'metadata.customer_name'
    ];

    /**
     * List all Orders
     *
     * @return array|object
     */
    public function listAllCharges() : array|object
    {
        return $this->get( endpoint: 'charges' );
    }

    /**
     * Show payment status.
     * 
     * Read more in: https://docs.cloud.coinbase.com/commerce/docs/payment-status
     *
     * @param string|integer $chargeId
     * @return string
     */
    public function viewStatusCharge(string|int $chargeId) : string {
        $charge = $this->showCharge($chargeId);
        $timeline = $charge->data->timeline;
        return end($timeline)->status ?? 'Error to get Status payment';
    }

    /**
     * Required params and no required params.
     * 
     * Please read more in: https://docs.cloud.coinbase.com/commerce/reference/createcharge
     *
     * @param array $params
     * @return array|object
     */
    public function createCharge(array $params = []) : array|object
    {
        $this->validateParameters(
            params: $params,
            requiredFields: $this->requiredParamsForCreateCharge
        );

        return $this->post(
            endpoint: 'charges',
            params: $params
        );
    }

    /**
     * Required ID of the order
     * 
     * Charge Code or ChargeID  
     *
     * @param string $chargeId
     * @return array|object
     */
    public function showCharge(string|int $chargeId) : array|object
    {
        return $this->get( endpoint: "charges/{$chargeId}" );
    }

    /**
     * Required ID of the order
     * 
     * Charge Code or ChargeID  
     *
     * @param string $chargeId
     * @return array|object
     */
    public function cancelCharge(string|int $chargeId) : array|object
    {
        return $this->post( endpoint: "charged/{$chargeId}/cancel" );
    }

    /**
     * Required ID of the order
     * 
     * Charge Code or ChargeID  
     *
     * @param string $chargeId
     * @return array|object
     */
    public function resolveCharge(string|int $chargeId) : array|object
    {
        return $this->post( endpoint: "charges/{$chargeId}" );
    }
}