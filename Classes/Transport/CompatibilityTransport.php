<?php
namespace NIMIUS\WebSms\Transport;

/*
 * This file is part of the "websms" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Compatibility transport class.
 *
 * Before TYPO3 8.1, guzzle needs to be used manually.
 */
class CompatibilityTransport extends AbstractTransport
{
    /**
     * Class constructor.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function post($url)
    {
    }
}
