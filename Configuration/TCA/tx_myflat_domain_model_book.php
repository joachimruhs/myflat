<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:myflat/Resources/Private/Language/locallang_db.xlf:tx_myflat_domain_model_book',
		'label' => 'arrival',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'default_sortby' => 'order by arrival desc',
		
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'arrival,departure,feuseruid,',
		'iconfile' => 'EXT:myflat/Resources/Public/Icons/tx_myflat_domain_model_book.gif'
	),

	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, arrival, departure, feuseruid, notes',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, arrival, departure, feuseruid, notes, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
	
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
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
				'foreign_table' => 'tx_myflat_domain_model_book',
				'foreign_table_where' => 'AND tx_myflat_domain_model_book.pid=###CURRENT_PID### AND tx_myflat_domain_model_book.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
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

		'arrival' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:myflat/Resources/Private/Language/locallang_db.xlf:tx_myflat_domain_model_book.arrival',
			'config' => array(
				'type' => 'input',
				'size' => 7,
				'eval' => 'date,required',
				'renderType' => 'inputDateTime',
				'checkbox' => 1,
//				'default' => time()
				'default' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
			)	
		),
		'departure' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:myflat/Resources/Private/Language/locallang_db.xlf:tx_myflat_domain_model_book.departure',
			'config' => array(
				'type' => 'input',
				'size' => 7,
				'eval' => 'date,required',
				'renderType' => 'inputDateTime',
				'checkbox' => 1,
//				'default' => time()
				'default' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
			),
		),
		'feuseruid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:myflat/Resources/Private/Language/locallang_db.xlf:tx_myflat_domain_model_book.feuseruid',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		
		'notes' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:myflat/Resources/Private/Language/locallang_db.xlf:tx_myflat_domain_model_book.notes',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
			)
		),


		'flat' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
	),
);
