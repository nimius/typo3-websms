<?php
namespace NIMIUS\WebSms\Transport;

/*
 * This file is part of the "websms" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

/**
 * Abstract transport class.
 */
abstract class AbstractTransport
{
    /**
     * @var string Base URI for API calls.
     */
    const BASE_URI = 'https://api.websms.com/rest/';

    /**
     * @var array Additional request headers.
     */
    protected $headers = [];

    /**
     * Sets headers.
     *
     * @param array $headers
     * @return void
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }

    /**
     * Set a specific header.
     *
     * @param string $key The name of this header.
     * @param string $value The value for this header.
     * @return void
     */
    public function setHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    /**
     * Get headers.
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Abstract POST method.
     *
     * Should send a POST request.
     *
     * @param string $uri The target URI.
     * @param array $data Form data to send with.
     * @param array $options Additional transport options.
     * @param string $requestMethod A request method, either form_data or json.
     * @return mixed A PSR-7 response.
     */
    abstract public function post($uri, array $data, $options = [], $requestMethod = '');
}
