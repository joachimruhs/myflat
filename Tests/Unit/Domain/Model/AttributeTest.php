<?php

namespace WSR\Myflat\Tests\Unit\Domain\Model;

/**
 * This file is part of the "myflat" Extension for TYPO3 CMS.
 *
 * For the full license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

/**
 * Test case for class \WSR\Myflat\Domain\Model\Attribute.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class AttributeTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \WSR\Myflat\Domain\Model\Attribute
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \WSR\Myflat\Domain\Model\Attribute();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getName()
		);
	}

	/**
	 * @test
	 */
	public function setNameForStringSetsName() {
		$this->subject->setName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'name',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getIconReturnsInitialValueForFileReference() {
		$this->assertEquals(
			NULL,
//			$this->subject->getIcon()
		);
	}

	/**
	 * @test
	 */
	public function setIconForFileReferenceSetsIcon() {
		$fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$this->subject->setIcon($fileReferenceFixture);

		$this->assertAttributeEquals(
			$fileReferenceFixture,
			'icon',
			$this->subject
		);
	}
}
