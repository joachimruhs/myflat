<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

$_EXTKEY = 'myflat';

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'WSR.' . $_EXTKEY,
	'Availabilityform',
	array(
		'Flat' => 'availabilityform, list, show, multirowcalendar',
		'Category' => 'list, show',
		
	),
	// non-cacheable actions
	array(
		'Flat' => 'availabilityform, multirowcalendar',
		'Category' => '',
		
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'WSR.' . $_EXTKEY,
	'Availabilitycheck',
	array(
		'Flat' => 'availabilitycheck, list, show, multirowcalendar',
		'Category' => 'list, show',
		
	),
	// non-cacheable actions
	array(
		'Flat' => 'availabilitycheck, multirowcalendar',
		'Category' => '',
		
	)
);




\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'WSR.' . $_EXTKEY,
	'Multirowcalendar',
	array(
		'Flat' => 'list, multirowcalendar, show, multirowcalendar',
		'Category' => 'list, show',
		
	),
	// non-cacheable actions
	array(
		'Flat' => 'list, show, multirowcalendar',
		'Category' => '',
		
	)
);
