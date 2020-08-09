<?php
defined('TYPO3_MODE') or die();

/*********
 * Plugins
 */

$_EXTKEY = 'myflat';

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
 
 
