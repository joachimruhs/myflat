<?php
namespace WSR\Myflat\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\Validate;
use TYPO3\CMS\Extbase\Annotation as Extbase;

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
	 * Sets the feueruid
	 * 
	 * @param integer $feueruid
	 * @return void
	 */
	public function setFeueruid($feueruid) {
		$this->feueruid = $feueruid;
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
		$this->feueruid = $notes;
	}

	
	
}