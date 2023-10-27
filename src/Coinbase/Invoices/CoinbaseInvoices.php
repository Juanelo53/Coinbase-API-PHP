<?php

namespace JuaneloCoinbase\Invoices;

use JuaneloCoinbase\Coinbase\SetCoinbase;

/**
 * Coinbase Class for Invoice methods.
 * @author Juanelo <juanelo@juanelocode.xyz>
 */


class CoinbaseInvoices extends SetCoinbase
{

    private array $requiredParamsForCreateInvoice = [
        'business_name',
        'customer_email',
        'customer_name',
        'memo',
        'local_price.amount',
        'local_price.currency'
    ];

    /**
     * Get all invoices. 
     *
     * @return array|object
     */
    public function listAllInvoices() : array|object
    {
        return $this->get( endpoint: "invoices" );
    }

    /**
     * Create Invoice. 
     * 
     * Required params for create the invoice.
     * 
     * Please read mode in: https://docs.cloud.coinbase.com/commerce/reference/createinvoice
     *
     * @param array $params
     * @return array|object
     */
    public function createInvoice(array $params = []) : array|object
    {
        $this->validateParameters(
            params: $params,
            requiredFields: $this->requiredParamsForCreateInvoice
        );
        return $this->post(
            endpoint: "invoices",
            params: $params
        );
    }

    /**
     * Show a Invoice. 
     * 
     * Required the Invoice ID
     *
     * @param string|integer $invoiceId
     * @return array|object
     */
    public function showInvoice(string|int $invoiceId) : array|object
    {
        return $this->get( endpoint: "invoices/{$invoiceId}" );
    }

    /**
     * Voids an invoice that has been previously created.
     * 
     * Required the Invoice ID
     *
     * @param string|integer $invoiceId
     * @return array|object
     */
    public function voidInvoice(string|int $invoiceId) : array|object
    {
        return $this->put( endpoint: "invoices/{$invoiceId}/void" );
    }

    /**
     * Resolve an invoice that has been previously marked as unresolved. 
     *
     * Required the Invoice ID
     * 
     * @param string|integer $invoiceId
     * @return array|object
     */
    public function resolveInvoice(string|int $invoiceId) : array|object
    {
        return $this->put( endpoint: "invoices/{$invoiceId}/resolve" );
    }
}