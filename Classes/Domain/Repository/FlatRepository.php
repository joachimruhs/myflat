<?php
namespace WSR\Myflat\Domain\Repository;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016-2020
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * The repository for Flats
 */
class FlatRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {
	//for each repository
/*
	  public function initializeObject() {
		$this->defaultQuerySettings->setRespectSysLanguage(TRUE);
	
		$language = $_GET['L'];
		debug($language, 'language im repos');
		if($language) {
		  $this->defaultQuerySettings->setSysLanguageUid($language);
		}
	  }
*/

	public function initializeObject1() { 
		// ATTENTION if this function is used missing storage pid can result...
		
		// HERE are the settings:
		/*
		$querySettings->setRespectStoragePage(FALSE); // ignore the storagePid
		$querySettings->setStoragePageIds(array(1, 2, 3)); // set some special storagePids
		$querySettings->setRespectEnableFields(FALSE); // ignore enableFields (…is deprecated)
		$querySettings->setIgnoreEnableFields(TRUE); // ignore the fields which are defined in TCA in key "enablecolumns"
		$querySettings->setEnableFieldsToBeIgnored(array('disabled', 'starttime')); // only ignore single enableFields
		$querySettings->setIncludeDeleted(TRUE); // also find the deleted rows
		$querySettings->setRespectSysLanguage(FALSE); // ignore the sys_language
		$querySettings->setSysLanguageUid(2); // set a special sys_language
		*/

		$defaultQuerySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
        // add the pid constraint
        $defaultQuerySettings->setRespectStoragePage(TRUE);



		// add sys_language_uid constraint
		$defaultQuerySettings->setRespectSysLanguage(TRUE);
		$this->setDefaultQuerySettings($defaultQuerySettings); 
	
		$language = $_GET['L'];
		if($language) {
		  $this->defaultQuerySettings->setSysLanguageUid(intval($language));
		}
		else $this->defaultQuerySettings->setSysLanguageUid(0);
		

	} 
		

  
	public function findByUidAndLang($uid, $storagePid){
		$query = $this ->createQuery();

		$query->getQuerySettings()->setRespectStoragePage(TRUE);

//        $query->getQuerySettings()->setStoragePageIds(array(1 => $storagePid));

		$language = $_GET['L'];
		if($language) {
		  $query->getQuerySettings()->setLanguageUid(intval($language));
		}
		else $query->getQuerySettings()->setLanguageUid(0);

/*		
		$query->matching(
			$query->logicalAND(
				$query->logicalOR(
					$query->equals('l10n_parent', $uid),
					$query->equals('uid1', $uid)
				),
				$query->equals('uid', $uid)
	
			)
		);
*/
		
		return $query->execute()->toArray();
		}

	public function findByUid($uid){
		$query = $this ->createQuery();
		$respectEnableFields = false;
		
		$query->getQuerySettings()->setRespectStoragePage(FALSE);
		$query->getQuerySettings()->setRespectSysLanguage(FALSE);
		$query->getQuerySettings()->setIgnoreEnableFields(!$respectEnableFields);
 

		$language = $_GET['L'];
		if($language) {
		  $query->getQuerySettings()->setLanguageUid(intval($language));
		}
		else $query->getQuerySettings()->setLanguageUid(0);


/*
		$query->matching(
			$query->logicalAND(
				$query->equals('l10n_parent', $uid),
				$query->equals('uid1', $uid)
	
			)
		);
*/
		$query->matching(
			$query->logicalAnd(
				$query->equals('uid', $uid),
				$query->equals('deleted', 0)
			)
		);
		return $query->execute()->getFirst();
	}	
	
	
	public function checkAvailability($uid, $arrival, $departure) {
		$query = $this ->createQuery();

//		debug(date('d.M.Y', $arrival) . ' - ' . date('d.M.Y', $departure));

		$result = $query->statement("select count(*) as counts from tx_myflat_domain_model_book a
									where flat = " . $uid ." AND a.deleted = 0
									 AND (" . $arrival . " > arrival AND " . $arrival . " < departure
									 OR " . $departure ." > arrival AND " . $departure . " < departure
									 OR " . $arrival ." <= arrival AND " . $departure . " >= departure
									 OR " . $arrival ." = arrival AND " . $departure . " = departure
									 
									 )
									"  )-> execute(true);

		if ($result[0]['counts']) return false;
		else return true;

	}
	
	public function findAllOverwrite($capacity) {
		$query = $this ->createQuery();

		$language = $_GET['L'];
		if($language) {
		  $query->getQuerySettings()->setLanguageUid(intval($language));
		}
		else $query->getQuerySettings()->setLanguageUid(0);
		
		if ($capacity) {
			$query->matching(
				$query->logicalAnd(
					$query->greaterThanOrEqual('capacity', intval($capacity))
				)
			);
		}
		
		return $query->execute(true);
	}
	



}