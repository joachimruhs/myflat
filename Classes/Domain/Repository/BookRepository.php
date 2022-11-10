<?php
namespace WSR\Myflat\Domain\Repository;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Extbase\Persistence\Generic\Query;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Core\Database\Query\Restriction\HiddenRestriction;

/**
 * This file is part of the "myflat" Extension for TYPO3 CMS.
 *
 * For the full license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

/**
 * The repository for Books
 */
class BookRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/*
	 *	get counts of bookings for a date period and flat
	 *
	 *	@param int $uid flatuid
	 *	@param int $arrival
	 *	@param int $departure
	 *
	 *	@return boolean
	 */	

	public function checkAvailability($uid, $arrival, $departure) {
		$queryBuilder = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Database\ConnectionPool::class)
			->getQueryBuilderForTable('tx_myflat_domain_model_book');

//		$queryBuilder->getRestrictions()->removeByType(HiddenRestriction::class);

		$queryBuilder->count('uid')->from('tx_myflat_domain_model_book')

		->where($queryBuilder->expr()->andX(
				$queryBuilder->expr()->andX(
					$queryBuilder->expr()->eq('flat', $queryBuilder->createNamedParameter($uid, \PDO::PARAM_INT))
				),
				$queryBuilder->expr()->andX(
					$queryBuilder->expr()->orX(
						$queryBuilder->expr()->andX(
							$queryBuilder->expr()->lt('arrival', $queryBuilder->createNamedParameter($arrival, \PDO::PARAM_INT)),
							$queryBuilder->expr()->gt('departure', $queryBuilder->createNamedParameter($arrival, \PDO::PARAM_INT))
						),
						$queryBuilder->expr()->andX(
							$queryBuilder->expr()->lt('arrival', $queryBuilder->createNamedParameter($departure, \PDO::PARAM_INT)),
							$queryBuilder->expr()->gt('departure', $queryBuilder->createNamedParameter($departure, \PDO::PARAM_INT))
						),
						$queryBuilder->expr()->andX(
							$queryBuilder->expr()->gte('arrival', $queryBuilder->createNamedParameter($arrival, \PDO::PARAM_INT)),
							$queryBuilder->expr()->lte('departure', $queryBuilder->createNamedParameter($departure, \PDO::PARAM_INT))
						),
						$queryBuilder->expr()->andX(
							$queryBuilder->expr()->eq('arrival', $queryBuilder->createNamedParameter($arrival, \PDO::PARAM_INT)),
							$queryBuilder->expr()->eq('departure', $queryBuilder->createNamedParameter($departure, \PDO::PARAM_INT))
						)
					)
				)
			)
		);
		$count = $queryBuilder->execute()->fetchOne();
		
		if ($count) return FALSE;
		else return TRUE;
	}


	
}