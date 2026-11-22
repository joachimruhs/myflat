<?php

declare(strict_types=1);

defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\GeneralUtility;

$_EXTKEY = 'myflat';

$pluginKey = 'myflat_multirowcalendar';

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Availabilityform',
	'MyFlat (availability form)'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Availabilitycheck',
	'MyFlat (availability check)'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Multirowcalendar',
	'MyFlat (multirow calendar)'
);

$typo3Version = GeneralUtility::makeInstance(Typo3Version::class);
$majorVersion = $typo3Version->getMajorVersion(); 
if ($majorVersion >= 13) {
    ExtensionManagementUtility::addToAllTCAtypes(
        'tt_content',
    //    '--div--;core.form.tabs:behavior, pages, recursive',
        '--div--;Plugin, pages, recursive',
        $pluginKey,
        'after:pi_flexform'
    );
}