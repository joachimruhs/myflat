<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

if (\TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger(TYPO3_branch) >
        \TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger('10.0')
    ) {
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'myflat',
	'Availabilityform',
	[
		\WSR\Myflat\Controller\FlatController::class => 'availabilityform, list, show, multirowcalendar',
		\WSR\Myflat\Controller\CategoryController::class => 'list, show',
	],
	// non-cacheable actions
	[
		\WSR\Myflat\Controller\FlatController::class => 'availabilityform, multirowcalendar',
	]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'myflat',
	'Availabilitycheck',
	[
		\WSR\Myflat\Controller\FlatController::class => 'availabilitycheck, list, show, multirowcalendar',
		\WSR\Myflat\Controller\CategoryController::class => 'list, show',
	],
	// non-cacheable actions
	[
		\WSR\Myflat\Controller\FlatController::class => 'availabilitycheck, multirowcalendar',
	]
);




\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'myflat',
	'Multirowcalendar',
	[
		\WSR\Myflat\Controller\FlatController::class => 'list, multirowcalendar, show, multirowcalendar',
		\WSR\Myflat\Controller\CategoryController::class => 'list, show',
	],
	// non-cacheable actions
	[
		\WSR\Myflat\Controller\FlatController::class => 'list, show, multirowcalendar',
	]
);
} else {

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

		
}		