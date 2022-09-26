<?php
namespace WSR\Myflat\Domain\Repository;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;

/**
 * This file is part of the "myflat" Extension for TYPO3 CMS.
 *
 * For the full license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

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
		

	/**
	 * Find all flats in storagePid with $language
	 *
	 * @param int uid not used !!!
	 * @param int  $storagePid
	 * @param int  $language
	 * 
	 * @return array flats
	 */  
	public function findByUidAndLang($uid, $storagePid, $languageUid) {
        $queryBuilder = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Database\ConnectionPool::class)
            ->getQueryBuilderForTable('tx_myflat_domain_model_flat');

        $queryBuilder->select('*')->from('tx_myflat_domain_model_flat', 'a');

        $arrayOfPids = \TYPO3\CMS\Core\Utility\GeneralUtility::intExplode(',', $storagePid, TRUE);

        $queryBuilder->where(
            $queryBuilder->expr()->in(
                'a.pid',
                $queryBuilder->createNamedParameter(
                    $arrayOfPids,
                    \Doctrine\DBAL\Connection::PARAM_INT_ARRAY
                )
            )
		);
/* language not used yet
        $queryBuilder->andWhere(
			$queryBuilder->expr()->orX(	
	            $queryBuilder->expr()->eq('sys_language_uid',
	                  $queryBuilder->createNamedParameter($languageUid, \PDO::PARAM_INT)
				),
	            $queryBuilder->expr()->eq('sys_language_uid',
	                  $queryBuilder->createNamedParameter(-1, \PDO::PARAM_INT)
				)
			)
		);
*/		
        $result = $queryBuilder->execute()->fetchAll();
        return $result;
	}

	public function findByUid($uid){
		$query = $this ->createQuery();
		$respectEnableFields = false;
		
		$query->getQuerySettings()->setRespectStoragePage(FALSE);
		$query->getQuerySettings()->setRespectSysLanguage(FALSE);
		$query->getQuerySettings()->setIgnoreEnableFields(!$respectEnableFields);
 

		$language = $_GET['L'] ?? 0;
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
				$query->equals('uid', intval($uid)),
				$query->equals('deleted', 0)
			)
		);
		return $query->execute()->getFirst();
	}	
	
	
	/**
	 * Find all flats in storagePid with capacity larger and eval $capacity
	 *
	 * @param int capacity
	 * @param int  $storagePid
	 * @param int  $language
	 * 
	 * @return array flats
	 */  
	public function findAllOverwrite($capacity, $storagePid, $languageUid) {
        $queryBuilder = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Database\ConnectionPool::class)
           ->getQueryBuilderForTable('tx_myflat_domain_model_flat');

        $queryBuilder->select('*')->from('tx_myflat_domain_model_flat', 'a');

        $arrayOfPids = \TYPO3\CMS\Core\Utility\GeneralUtility::intExplode(',', $storagePid, TRUE);

        $queryBuilder->where(
            $queryBuilder->expr()->in(
                'a.pid',
                $queryBuilder->createNamedParameter(
                    $arrayOfPids,
                    \Doctrine\DBAL\Connection::PARAM_INT_ARRAY
                )
            )
		);
        $queryBuilder->andWhere(
/* language not used yet
			$queryBuilder->expr()->orX(	
	            $queryBuilder->expr()->eq('sys_language_uid',
	                  $queryBuilder->createNamedParameter($languageUid, \PDO::PARAM_INT)
				),
	            $queryBuilder->expr()->eq('sys_language_uid',
	                  $queryBuilder->createNamedParameter(-1, \PDO::PARAM_INT)
				)
			),
*/
			$queryBuilder->expr()->andX(
	            $queryBuilder->expr()->gte('capacity',
	                  $queryBuilder->createNamedParameter($capacity, \PDO::PARAM_INT)
				)
			)
		);
        $result = $queryBuilder->execute()->fetchAll();
        return $result;
	}
	



}