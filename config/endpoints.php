<?php

/**
 * IPag API Endpoints
 * @link https://developers.ipag.com.br/
 */
return [

    /**
     * Get access token
     * @link https://docs.galaxpay.com.br/auth/token
     */
    'authenticate' => ['method' => 'GET', 'route' => '/v2/token'],

    /**
     * List Customers
     * @link https://developers.ipag.com.br/pt-br/customer?id=listar-clientes
     */
    'listCustomers' => ['method' => 'GET', 'route' => '/service/resources/customers'],

    /**
     * Create Customer
     * @link https://developers.ipag.com.br/pt-br/customer?id=novo-cliente
     */
    'createCustomer' => ['method' => 'POST', 'route' => '/service/resources/customers'],

    /**
     * Edit customer
     * @link https://developers.ipag.com.br/pt-br/customer?id=alterar-cliente
     */
    'editCustomer' => ['method' => 'PUT', 'route' => '/service/resources/customers?id=:customerId'],

    /**
     * Delete customer
     * @link https://developers.ipag.com.br/pt-br/customer?id=deletar-cliente
     */
    'deleteCustomer' => ['method' => 'DELETE', 'route' => '/service/resources/customers?id=:customerId'],

    /**
     * List plan
     * @link https://developers.ipag.com.br/pt-br/subscription_plan?id=listar-planos-de-assinatura
     */
    'listPlans' => ['method' => 'GET', 'route' => '/service/resources/plans'],

    /**
     * Create plan
     * @link https://developers.ipag.com.br/pt-br/subscription_plan?id=novo-plano-de-assinatura
     */
    'createPlan' => ['method' => 'POST', 'route' => '/service/resources/plans'],

    /**
     * Edit plan
     * @link https://developers.ipag.com.br/pt-br/subscription_plan?id=alterar-plano-de-assinatura
     */
    'editPlan' => ['method' => 'PUT', 'route' => '/service/resources/plans?id=:planId'],

    /**
     * Delete plan
     * @link https://developers.ipag.com.br/pt-br/subscription_plan?id=deletar-plano-de-assinatura
     */
    'deletePlan' => ['method' => 'DELETE', 'route' => '/service/resources/plans?id=:planId'],

    /**
     * List individual charges
     * @link https://developers.ipag.com.br/pt-br/charge?id=listar-cobran%c3%a7a
     */
    'listCharges' => ['method' => 'GET', 'route' => '/service/resources/charges'],

    /**
     * Create individual charge
     * @link https://developers.ipag.com.br/pt-br/charge?id=nova-cobran%c3%a7a
     */
    'createCharge' => ['method' => 'POST', 'route' => '/service/resources/charges'],

    /**
     * Edit individual charge
     * @link https://developers.ipag.com.br/pt-br/charge?id=alterar-cobran%c3%a7a
     */
    'editCharge' => ['method' => 'PUT', 'route' => '/service/resources/charges?id=:chargeId'],

    /**
     * List transactions
     * @link https://developers.ipag.com.br/pt-br/transaction?id=listar-transa%c3%a7%c3%b5es
     */
    'listTransactions' => ['method' => 'GET', 'route' => '/service/resources/transactions'],

];
