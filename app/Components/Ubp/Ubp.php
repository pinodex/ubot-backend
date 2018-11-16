<?php

namespace App\Components\Ubp;

class Ubp
{
    /**
     * Guzzle Client instance
     * @var GuzzleHttp\Client
     */
    private $client;

    /**
     * UnionBankPH application client ID
     * @var string
     */
    private $clientId;

    /**
     * UnionBankPH application client secret
     * @var string
     */
    private $clientSecret;

    /**
     * Base path for API endpoints
     * @var string
     */
    private $basePath;

    /**
     * Redirect URI for login
     * @var string
     */
    private $redirectUri;

    /**
     * Scope for oauth flow
     * @var array
     */
    private $loginScopes = [
        //'payments',
        //'transfers',
        //'account_balances',
        //'account_info',
        //'card_inquiry',
        //'accounts_sandbox',
        //'account_transactions',
        'account_info'
    ];

    /**
     * Instantiates Ubp
     *
     * @param array $config Array of Ubp config
     */
    public function __construct($client, $config) {
        $this->client = $client;

        $this->clientId = $config['client_id'];
        $this->clientSecret = $config['client_secret'];
        $this->basePath = $config['base_path'];
        $this->redirectUri = $config['redirect_uri'];
    }

    /**
     * Get Guzzle client
     *
     * @return GuzzleHttp\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Get login URI for oauth flow
     * @return string
     */
    public function getLoginUri($scope)
    {
        return sprintf('%s/convergent/v1/oauth2/authorize?%s',
            $this->basePath,

            http_build_query([
                'client_id' => $this->clientId,
                'redirect_uri' => $this->redirectUri,
                'response_type' => 'code',
                'type' => 'linking',
                'partnerId' => '5dff2cdf-ef15-48fb-a87b-375ebff415bb',
                'scope' => $scope
            ])
        );
    }

    /**
     * Obtain access token from code
     *
     * @param string $code Oauth code
     *
     * @return string
     */
    public function obtainAccessToken($code)
    {
        $response = $this->client->post('convergent/v1/oauth2/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'redirect_uri' => $this->redirectUri,
                'client_id' => $this->clientId,
                'code' => $code
            ]
        ]);

        return json_encode($response->getBody()->getContents(), true);
    }
}
