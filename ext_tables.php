<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

$_EXTKEY = 'myflat';

/*
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
*/


//\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'MyFlat');




\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_myflat_domain_model_flat', 'EXT:myflat/Resources/Private/Language/locallang_csh_tx_myflat_domain_model_flat.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_myflat_domain_model_flat');



\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_myflat_domain_model_category', 'EXT:myflat/Resources/Private/Language/locallang_csh_tx_myflat_domain_model_category.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_myflat_domain_model_category');


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_myflat_domain_model_attribute', 'EXT:myflat/Resources/Private/Language/locallang_csh_tx_myflat_domain_model_attribute.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_myflat_domain_model_attribute');



\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_myflat_domain_model_book', 'EXT:myflat/Resources/Private/Language/locallang_csh_tx_myflat_domain_model_book.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_myflat_domain_model_book');
