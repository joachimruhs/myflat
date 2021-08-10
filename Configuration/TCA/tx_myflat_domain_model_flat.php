<?php

use TYPO3\CMS\Core\Utility\GeneralUtility;


if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$Typo3Version = GeneralUtility::makeInstance(TYPO3\CMS\Core\Information\Typo3Version::class);
$version9 = \TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger($Typo3Version->getBranch()) >= \TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger('9.3');
$generalLanguageFilePrefix = $version9 ? 'LLL:EXT:core/Resources/Private/Language/' : 'LLL:EXT:lang/Resources/Private/Language/';

return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:myflat/Resources/Private/Language/locallang_db.xlf:tx_myflat_domain_model_flat',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
//			'starttime' => 'starttime',
//			'endtime' => 'endtime',
		),
		'searchFields' => 'name,address,zipcode,city,country,capacity,lat,lon,description,images,category,attribute,book,',
		'iconfile' => 'EXT:myflat/Resources/Public/Icons/tx_myflat_domain_model_flat.gif'
	),

	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, address, zipcode, city, country, capacity, lat, lon, description, images, category, attribute, book',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, address, zipcode, city, country, capacity, lat, lon, description, images, category, attribute, book, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
	
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => $generalLanguageFilePrefix . 'locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',				
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',				
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_myflat_domain_model_flat',
				'foreign_table_where' => 'AND tx_myflat_domain_model_flat.pid=###CURRENT_PID### AND tx_myflat_domain_model_flat.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		'hidden' => array(
			'exclude' => 1,
			'label' => $generalLanguageFilePrefix . 'locallang_general.xlf:LGL.hidden',
 			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
//			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'eval' => 'datetime',
				'renderType' => 'inputDateTime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
				'behaviour' => array (
					'allowLanguageSynchronization' => 1
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
//			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'eval' => 'datetime',
				'renderType' => 'inputDateTime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
				'behaviour' => array (
					'allowLanguageSynchronization' => 1
				),
			),
		),

		'name' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:myflat/Resources/Private/Language/locallang_db.xlf:tx_myflat_domain_model_flat.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'address' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:myflat/Resources/Private/Language/locallang_db.xlf:tx_myflat_domain_model_flat.address',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'zipcode' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:myflat/Resources/Private/Language/locallang_db.xlf:tx_myflat_domain_model_flat.zipcode',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'city' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:myflat/Resources/Private/Language/locallang_db.xlf:tx_myflat_domain_model_flat.city',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'country' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:myflat/Resources/Private/Language/locallang_db.xlf:tx_myflat_domain_model_flat.country',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'capacity' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:myflat/Resources/Private/Language/locallang_db.xlf:tx_myflat_domain_model_flat.capacity',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'lat' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:myflat/Resources/Private/Language/locallang_db.xlf:tx_myflat_domain_model_flat.lat',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			),
		),
		'lon' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:myflat/Resources/Private/Language/locallang_db.xlf:tx_myflat_domain_model_flat.lon',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'description' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:myflat/Resources/Private/Language/locallang_db.xlf:tx_myflat_domain_model_flat.description',
			'config' => array(

			'type' => 'text',
			'enableRichtext' => true,
			'fieldControl' => [
				'fullScreenRichtext' => [
					'disabled' => false,
				],
			],

				
			),

//			'defaultExtras' => 'richtext[*]'


		),
        'images' => array(
                'exclude' => 1,
                'label' => 'Images',
                'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('images', array(
                        'appearance' => array(
                                'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
                        ),
                        'minitems' => 0,
                        'maxitems' => 10,
                ), $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']),
        ),
		
		'category' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:myflat/Resources/Private/Language/locallang_db.xlf:tx_myflat_domain_model_flat.category',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',				
				'foreign_table' => 'tx_myflat_domain_model_category',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'attribute' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:myflat/Resources/Private/Language/locallang_db.xlf:tx_myflat_domain_model_flat.attribute',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_myflat_domain_model_attribute',
				'MM' => 'tx_myflat_flat_attribute_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,

				'fieldControl' => [
					'editPopup' => [
						'disabled' => false,
					],
					'addRecord' => [
						'disabled' => false,
						'options' => [
							'setValue' => 'prepend',
						],
					],
					'listModule' => [
						'disabled' => false,
					],
				],
				

			),
		),
		'book' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:myflat/Resources/Private/Language/locallang_db.xlf:tx_myflat_domain_model_flat.book',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_myflat_domain_model_book',
				'foreign_field' => 'flat',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapseAll' => 1,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),

		),
		
	),
);
