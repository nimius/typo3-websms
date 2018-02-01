# websms TYPO3 CMS extension

This extension provides a simple interface to interact with
the [websms](https://developer.websms.com/web-api/) gateway.

Unter the hood, [guzzle](https://github.com/guzzle/guzzle) is used for calling the REST API through cUrl.

If your TYPO3 CMS version is lower than 8.1, guzzle is used directly without respecting any TYPO3-specific settings. If you're over 8.1, guzzle is already [part of the core](https://docs.typo3.org/typo3cms/CoreApiReference/ApiOverview/Http/Index.html) and integrates environment settings.

## Example usage
This is an example service class that you may implement for
delivering messages to the websms gateway.

```php
<?php
namespace Foo\Bar\Service;

use NIMIUS\WebSms\Gateway\Gateway;
use NIMIUS\WebSms\Message\SmsMessage;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class SmsService
{
    /**
     * Example method to send SMS to a recipient.
     *
     * @param string $recipient
     * @param string $text
     * @return bool
     */
    public function sendMessage(string $recipient, string $text)
    {
        // Setting up a gateway instance for sending messages.
        $gateway = GeneralUtility::makeInstance(Gateway::class);

        /*
         * You need to fetch your private access token
         * from your own extension configuration or from
         * your environment configuration.
         */
        $gateway->setAccessToken('my-private-access-token');

        // For testing purposes, test mode is enabled.
        $gateway->setTestMode(true);

        // Setting up an SMS message instance.
        $message = GeneralUtility::makeInstance(SmsMessage::class);

        // Adding a recipient. The number format follows MSISDN.
        $message->addRecipient('410000000');

        // Setting the message content that is being delivered.
        $message->setContent('Hello world!');

        // Passing the message to the gateway instance yields a response.
        $response = $gateway->send($message);

        return $response->isSuccessful();
    }
}
```
