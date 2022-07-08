<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Ipag Environment
     |--------------------------------------------------------------------------
     |
     | This value defines the environment in which Ipag will run,
     | 'sandbox' for development and 'production' for production environment.
     | It also determines the URL that will be used as a basis for requests.
     |
     */

    'env' => env('IPAG_ENV', 'sandbox'),

    'api_urls' => [
        'production' => env('IPAG_URL_PRODUCTION', 'https://api.ipag.com.br'),
        'sandbox'    => env('IPAG_URL_SANDBOX', 'https://sandbox.ipag.com.br')
    ],

    /*
    |--------------------------------------------------------------------------
    | Ipag URL Type ID
    |--------------------------------------------------------------------------
    |
    | This value determines the default id type that will be used 
    | in the endpoints that need the typeId.
    |
    */
    'default_id_type' => env('IPAG_TYPE_ID', 'myId'),

    /*
     |--------------------------------------------------------------------------
     | Ipag Partner
     |--------------------------------------------------------------------------
     |
     | This value defines the Ipag API authentication as a partner.
     | 
     | If you are only going to work with one client, change the 'session_driver'
     | to 'file' and put your credentials in credentials.partner and the client's
     | in credentials.client.
     |
     | If you are going to work with more than one client, change the 'session_driver'
     | to 'database' and publish the migrations.
     |
     */

    'auth_as_partner' => env('IPAG_AUTH_AS_PARTNER', false),

    /*
     |-------------------------------------------------------------------------- 
     | Ipag Credentials
     |--------------------------------------------------------------------------
     |
     | After creating a Ipag account, you are given a 
     | 'ipag_id' and a 'ipag_hash' to authenticate to the API.
     | 
     | If you are authenticating as a partner, put your credentials in 
     | 'credentials.partner' and if you are only working with one client, 
     | put the client's credentials in 'credentials.client'. Otherwise, 
     | put your credentials in 'credentials.client'.
     |
     */

    'credentials' => [
        'client' => [
            'id' => env('IPAG_CLIENT_ID', null),
            'hash' => env('IPAG_CLIENT_HASH', null),
        ],
        'partner' => [
            'id' => env('IPAG_PARTNER_ID', null),
            'hash' => env('IPAG_PARTNER_HASH', null),
        ]
    ],

    /*
     |--------------------------------------------------------------------------
     | Ipag Webhook Hash
     |--------------------------------------------------------------------------
     |
     | The webhook_hash is for you to be sure that it was Ipag that 
     | sent you the request and not a third party trying to break into 
     | your system, it can be obtained from the Ipag system.
     |
     */

    'webhook_hash' => env('IPAG_WEBHOOK_HASH', null),

    /*
     |--------------------------------------------------------------------------
     | Ipag Scopes
     |--------------------------------------------------------------------------
     |
     | All possible Ipag request scopes
     |
     */

    'scopes' => 'boletos.read card-brands.read cards.read cards.write carnes.read charges.read charges.write customers.read customers.write payment-methods.read plans.read plans.write subscriptions.read subscriptions.write transactions.read transactions.write webhooks.write',

    /*
     |--------------------------------------------------------------------------
     | Ipag Session Driver
     |--------------------------------------------------------------------------
     |
     | This value determines whether authentication sections will be saved in 
     | 'file' or 'database'. Session driver: database, must be used when 
     | authentication is with partner and you are working with more than 
     | one customer, customer credentials must be saved in ipag_clients table.
     |
     */

    'session_driver' => env('IPAG_SESSION_DRIVER', 'file'),

    /*
     |--------------------------------------------------------------------------
     | Ipag Client
     |--------------------------------------------------------------------------
     |
     | Table responsible for storing the credentials of Ipag clients.
     | The entity and entity_id columns refer to the entity
     | that owns the ipag_id and ipag_hash credentials.
     |
     */

    'ipag_clients' => [
        'ref'          => \Samueletur\IpagLaravel\Models\IpagClient::class,
        // Columns
        'model_type'   => 'model_type',
        'model_id'     => 'model_id',
        'ipag_id'     => 'ipag_id',
        'ipag_hash'   => 'ipag_hash',
        'webhook_hash' => 'webhook_hash',
    ],

    /*
    |--------------------------------------------------------------------------
    | Ipag Sessions
    |--------------------------------------------------------------------------
    |
    | Table responsible for storing session tokens in the Ipag API
    |
    */

    'ipag_sessions' => [
        'ref'          => \Samueletur\IpagLaravel\Models\IpagSession::class,
        // Columns
        'scope'        => 'scope',
        'expires_in'   => 'expires_in',
        'token_type'   => 'token_type',
        'access_token' => 'access_token',
        'client_id'    => 'ipag_client_id',
    ]
];
