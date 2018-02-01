<?php
namespace NIMIUS\WebSms\Message;

/*
 * This file is part of the "websms" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

/**
 * Abstract message class.
 *
 * Base class for all message types.
 */
abstract class AbstractMessage
{
    /**
     * @var array MSISDN conform phone numbers.
     * @see https://en.wikipedia.org/wiki/MSISDN
     */
    protected $recipients = [];

    /**
     * @var string The message content.
     */
    protected $content = '';

    /**
     * Sets the recipients list.
     *
     * @param array $recipients
     * @return void
     */
    public function setRecipients(array $recipients)
    {
        $this->recipients = $recipients;
    }

    /**
     * Adds a recipient.
     *
     * @param string $recipient
     * @return void
     */
    public function addRecipient($recipient)
    {
        if (!in_array($recipient, $this->recipients)) {
            $this->recipients[] = $recipient;
        }
    }

    /**
     * Returns recipients.
     *
     * @return array
     */
    public function getRecipients(): array
    {
        return $this->recipients;
    }

    /**
     * Sets the message content.
     *
     * @var string
     * @return void
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * Returns the message.
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
