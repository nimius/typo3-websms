<?php
namespace NIMIUS\WebSms\Transport;

/*
 * This file is part of the "websms" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Compatibility transport class.
 *
 * Before TYPO3 8.1, guzzle needs to be used standalone.
 */
class CompatibilityTransport extends AbstractTransport
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * Class constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => AbstractTransport::BASE_URI
        ]);
    }

    /**
     * POST method.
     *
     * Sends a POST request.
     *
     * @param string $uri The target URI.
     * @param array $data Form data to send with.
     * @param array $options Additional transport options.
     * @param string $requestMethod A request method, either form_data or json.
     * @return mixed A PSR-7 response.
     */
    public function post(string $uri, array $data, array $options = [], string $requestMethod = 'form_data')
    {
        $requestOptions = array_merge(
            $options,
            [
                $requestMethod => $data,
                'headers' => $this->getHeaders(),
                'http_errors' => false
            ]
        );
        return $this->client->request('POST', $uri, $requestOptions);
    }
}
