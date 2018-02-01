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
     * @var string Base url for API calls.
     */
    const BASE_URL = 'https://api.websms.com/rest/';

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

    abstract public function post($url);
}
