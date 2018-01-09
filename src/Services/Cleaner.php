<?php
/**
 * @author Maksim Khodyrev<maximkou@gmail.com>
 * 09.01.18
 */

namespace Maximkou\LaravelOpcacheClear;

use GuzzleHttp\Client;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Encryption\Encrypter;

/**
 * Class Cleaner
 * @package Maximkou\LaravelOpcacheClear
 */
class Cleaner
{
    /**
     * @var Encrypter
     */
    private $encrypter;

    /**
     * @var Repository
     */
    private $config;

    /**
     * Cleaner constructor.
     * @param Encrypter $encrypter
     * @param Repository $config
     */
    public function __construct(Encrypter $encrypter, Repository $config)
    {
        $this->encrypter = $encrypter;
        $this->config = $config;
    }

    /**
     * Make request to target URI
     * @return bool
     */
    public function sendClearRequest()
    {
        $httpClient = new Client(array_merge(
            [
                'base_uri' => $this->config->get('app.url', 'http://localhost')
            ],
            $this->config->get('laravel-opcache-clear.guzzle_options', [])
        ));

        $response = $httpClient->get(
            $this->config->get('laravel-opcache-clear.uri_slug'),
            [
                'query' => [
                    'token' => $this->encrypter->encrypt($this->getOriginToken())
                ]
            ]
        );

        $response = json_decode($response->getBody(), true);

        return is_array($response) && !empty($response['result']);
    }

    /**
     * Clear opcache if token match
     * @param $securityToken
     * @return bool
     */
    public function clear($securityToken)
    {
        try {
            $token = $this->encrypter->decrypt($securityToken);
        } catch (DecryptException $e) {
            return false;
        }

        return $token == $this->getOriginToken() && $this->isOpcacheInstalled() && opcache_reset();
    }

    /**
     * @return string
     */
    private function getOriginToken()
    {
        return $this->config->get('app.key');
    }

    /**
     * @return bool
     */
    private function isOpcacheInstalled()
    {
        return function_exists('opcache_reset');
    }
}
