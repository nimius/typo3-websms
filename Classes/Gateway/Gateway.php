<?php
namespace NIMIUS\WebSms\Gateway;

/*
 * This file is part of the "websms" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use NIMIUS\WebSms\Transport\CompatibilityTransport;
use NIMIUS\WebSms\Transport\NativeTransport;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\VersionNumberUtility;

/**
 * Gateway class.
 *
 * Responsible for transporting messages to the
 * websms endpoint.
 */
class Gateway
{
    /**
     * @var mixed Transport class instance.
     */
    protected $transport;

    /**
     * @var string API access token.
     */
    protected $accessToken = '';

    /**
     * @var bool Test mode flag.
     */
    protected $testMode = false;

    /**
     * Gateway constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $currentVersion = VersionNumberUtility::convertVersionNumberToInteger(
            VersionNumberUtility::getCurrentTypo3Version()
        );
        $targetVersion = VersionNumberUtility::convertVersionNumberToInteger('8.1.0');

        if ($currentVersion < $targetVersion) {
            $this->transport = GeneralUtility::makeInstance(CompatibilityTransport::class);
        } else {
            $this->transport = GeneralUtility::makeInstance(NativeTransport::class);
        }
    }

    /**
     * Transport class setter.
     *
     * @param mixed $transport
     * @return void
     */
    public function setTransport($transport)
    {
        $this->transport = $transport;
    }

    /**
     * Setter for access token.
     *
     * @param string $token
     * @return void
     */
    public function setAccessToken(string $token)
    {
        $this->accessToken = $token;
    }

    /**
     * Setter for test mode.
     *
     * @param bool $mode
     * @return void
     */
    public function setTestMode(bool $mode)
    {
        $this->testMode = $mode;
    }

    /**
     * Send method.
     *
     * Sends the given message instance via $transport to the API for delivery.
     * This uses 'smsmessaging/text' instead of 'smsmessaging/simple'; It
     * requires more work but allows UTF-8 sms content.
     *
     * @param mixed $message
     * @return void
     */
    public function send($message)
    {
        $this->transport->setHeaders(
            [
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json; charset=utf8'
            ]
        );

        $response = $this->transport->post(
            'smsmessaging/text',
            [
                'recipientAddressList' => $message->getRecipients(),
                'messageContent' => $message->getContent(),
                'test' => ($this->testMode ? 'true' : 'false')
            ],
            [],
            'json'
        );

        return $response;
    }
}
