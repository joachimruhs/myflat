<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

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
