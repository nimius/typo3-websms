<?php
/*
 * This file is part of the "websms" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

$EM_CONF[$_EXTKEY] = [
    'title' => 'WebSMS',
    'description' => 'websms.ch Gateway for TYPO3 CMS.',
    'category' => 'be',
    'version' => '0.1.0',
    'state' => 'beta',
    'author' => 'NIMIUS GmbH',
    'author_email' => 'info@nimius.net',
    'constraints' => [
        'depends' => [
            'typo3' => '7.6.0-8.7.99',
        ],
    ],
];
