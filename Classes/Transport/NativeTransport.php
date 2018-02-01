<?php
namespace NIMIUS\WebSms\Transport;

/*
 * This file is part of the "websms" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use TYPO3\CMS\Core\Http\RequestFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Native transport class.
 *
 * Since TYPO3 8.1, guzzle is integrated into the
 * core and a request factory is provided for
 * configuring guzzle according to the TYPO3 configuration.
 *
 * @see https://docs.typo3.org/typo3cms/CoreApiReference/ApiOverview/Http/Index.html
 */
class NativeTransport extends AbstractTransport
{
    /**
     * Class constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->requestFactory = GeneralUtility::makeInstance(RequestFactory::class);
    }

    /**
     * POST method.
     *
     * Sends a POST request.
     *
     * @param string $uri The target URI
     * @param array $data Form data to send with
     * @param array $options Additional transport options.
     * @return mixed A PSR-7 response.
     */
    public function post($uri, $data, $options = [])
    {
        // TODO implement return $this->requestFactory->request($url, 'POST');
    }
}
