<?php
namespace NIMIUS\WebSms\Response;

/*
 * This file is part of the "websms" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

/**
 * Response class.
 *
 * Request response class.
 */
class Response
{
    /**
     * @var int Request accepted, message(s) sent.
     */
    const STATUS_OK = 2000;

    /**
     * @var int Request accepted, message(s) queued.
     */
    const STATUS_OK_QUEUED = 2001;

    /**
     * @var \GuzzleHttp\Psr7\Response
     */
    protected $originalResponse;

    /**
     * @var int Status code from websms.
     * @see https://developer.websms.com/web-api/#statuscodes
     */
    protected $statusCode;

    /**
     * @var int Status message from websms.
     * @see https://developer.websms.com/web-api/#statuscodes
     */
    protected $statusMessage;

    /**
     * @var string Error message that does not map to a status.
     */
    protected $errorMessage;

    /**
     * @var string Message transfer identificator.
     */
    protected $transferId;

    /**
     * @var int How many SMS the delivered message required.
     */
    protected $smsCount;

    /**
     * Class constructor.
     *
     * @param \GuzzleHttp\Psr7\Response $response
     * @return void
     */
    public function __construct(\GuzzleHttp\Psr7\Response $response)
    {
        $this->originalResponse = $response;
        $this->parseResponse();
    }

    /**
     * Getter for the original guzzle response.
     *
     * @return \GuzzleHttp\Psr7\Response
     */
    public function getOriginalResponse()
    {
        return $this->originalResponse;
    }

    /**
     * Logical getter for checking if the response is positive.
     *
     * @return bool
     */
    public function isSuccessful()
    {
        return ($this->statusCode == self::STATUS_OK
                || $this->statusCode == self::STATUS_OK_QUEUED);
    }

    /**
     * Parses response into properties.
     *
     * The response may either be in XML or JSON format.
     *
     * @return void
     */
    protected function parseResponse()
    {
        $body = $this->originalResponse->getBody();

        $response = json_decode($body);
        if (!$response) {
            libxml_use_internal_errors(true);
            $response = simplexml_load_string($body);
        }

        if ($response) {
            $this->errorMessage = (string)$response->error_description;
            $this->statusCode = (int)$response->statusCode;
            $this->statusMessage = (string)$response->statusMessage;
            $this->smsCount = (int)$response->smsCount;
            $this->transferId = (string)$response->transferId;
        }
    }
}
