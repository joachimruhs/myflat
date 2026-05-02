<?php
defined('TYPO3') or die();

call_user_func(
    function()
    {
		/**
		 * Register icons
		 */

		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		$iconRegistry->registerIcon(
			'extension-myflat-content-element',
			\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
			['source' => 'EXT:myflat/Resources/Public/Icons/ext_myflat.svg']
		);
    }
);	

