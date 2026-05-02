<?php
defined('TYPO3') or die();

use \TYPO3\CMS\Extbase\Utility\ExtensionUtility;

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
	],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT,
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
	],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT,
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
	],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT,
);
