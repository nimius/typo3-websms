<?php
namespace NIMIUS\WebSms\Transport;

/*
 * This file is part of the "websms" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\VersionNumberUtility;

/**
 * Transport factory class.
 */
class TransportFactory
{
    /**
     * Returns an instance of a suiting transport class
     * based on the current TYPO3 CMS version.
     *
     * @return mixed
     */
    public static function getTransportInstanceForCurrentTypo3Version()
    {
        $currentVersion = VersionNumberUtility::convertVersionNumberToInteger(
            VersionNumberUtility::getCurrentTypo3Version()
        );
        $targetVersion = VersionNumberUtility::convertVersionNumberToInteger('8.1.0');

        if ($currentVersion < $targetVersion) {
            $class = CompatibilityTransport::class;
        } else {
            $class = NativeTransport::class;
        }
        return GeneralUtility::makeInstance($class);
    }
}
