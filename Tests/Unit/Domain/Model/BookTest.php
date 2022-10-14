<?php

namespace WSR\Myflat\Tests\Unit\Domain\Model;

/**
 * This file is part of the "myflat" Extension for TYPO3 CMS.
 *
 * For the full license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

/**
 * Test case for class \WSR\Myflat\Domain\Model\Book.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class BookTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \WSR\Myflat\Domain\Model\Book
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \WSR\Myflat\Domain\Model\Book();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getArrivalReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getArrival()
		);
	}

	/**
	 * @test
	 */
	public function setArrivalForDateTimeSetsArrival() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setArrival($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'arrival',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDepartureReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getDeparture()
		);
	}

	/**
	 * @test
	 */
	public function setDepartureForDateTimeSetsDeparture() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setDeparture($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'departure',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFeuseruidReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getFeuseruid()
		);
	}

	/**
	 * @test
	 */
	public function setFeuseruidForIntegerSetsFeuseruid() {
		$this->subject->setFeuseruid(12);

		$this->assertAttributeEquals(
			12,
			'feuseruid',
			$this->subject
		);
	}
}
