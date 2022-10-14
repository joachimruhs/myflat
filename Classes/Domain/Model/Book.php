<?php
namespace WSR\Myflat\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Annotation as Extbase;

/**
 * This file is part of the "myflat" Extension for TYPO3 CMS.
 *
 * For the full license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

/**
 * Book
 */
class Book extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * arrival
	 * 
	 * @var \DateTime
	 * @Extbase\Validate(validator="NotEmpty")
	 */
	protected $arrival = NULL;

	/**
	 * departure
	 * 
	 * @var \DateTime
	 * @Extbase\Validate(validator="NotEmpty")
	 */
	protected $departure = NULL;

	/**
	 * feueruid
	 * 
	 * @var integer
	 */
	protected $feueruid = 0;

	/**
	 * notes
	 *
	 *  
	 * @var string
	 */
	protected $notes = "";



	/**
	 * Returns the arrival
	 * 
	 * @return \DateTime $arrival
	 */
	public function getArrival() {
		return $this->arrival;
	}

	/**
	 * Sets the arrival
	 * 
	 * @param \DateTime $arrival
	 * @return void
	 */
	public function setArrival(\DateTime $arrival) {
		$this->arrival = $arrival;
	}

	/**
	 * Returns the departure
	 * 
	 * @return \DateTime $departure
	 */
	public function getDeparture() {
		return $this->departure;
	}

	/**
	 * Sets the departure
	 * 
	 * @param \DateTime $departure
	 * @return void
	 */
	public function setDeparture(\DateTime $departure) {
		$this->departure = $departure;
	}

	/**
	 * Returns the feueruid
	 * 
	 * @return integer $feueruid
	 */
	public function getFeueruid() {
		return $this->feueruid;
	}

	/**
	 * Sets the feuseruid
	 * 
	 * @param integer $feuseruid
	 * @return void
	 */
	public function setFeuseruid($feuseruid) {
		$this->feuseruid = $feuseruid;
	}

	/**
	 * Returns the notes
	 * 
	 * @return string $notes
	 */
	public function getNotes() {
		return $this->notes;
	}

	/**
	 * Sets the notes
	 * 
	 * @param string $notes
	 * @return void
	 */
	public function setNotes($notes) {
		$this->notes = $notes;
	}

	
	
}