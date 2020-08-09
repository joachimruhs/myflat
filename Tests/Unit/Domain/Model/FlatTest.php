<?php

namespace WSR\Myflat\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \WSR\Myflat\Domain\Model\Flat.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class FlatTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \WSR\Myflat\Domain\Model\Flat
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \WSR\Myflat\Domain\Model\Flat();
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
	public function getAddressReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getAddress()
		);
	}

	/**
	 * @test
	 */
	public function setAddressForStringSetsAddress() {
		$this->subject->setAddress('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'address',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getZipcodeReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getZipcode()
		);
	}

	/**
	 * @test
	 */
	public function setZipcodeForStringSetsZipcode() {
		$this->subject->setZipcode('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'zipcode',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCityReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getCity()
		);
	}

	/**
	 * @test
	 */
	public function setCityForStringSetsCity() {
		$this->subject->setCity('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'city',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCountryReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getCountry()
		);
	}

	/**
	 * @test
	 */
	public function setCountryForStringSetsCountry() {
		$this->subject->setCountry('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'country',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCapacityReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getCapacity()
		);
	}

	/**
	 * @test
	 */
	public function setCapacityForIntegerSetsCapacity() {
		$this->subject->setCapacity(12);

		$this->assertAttributeEquals(
			12,
			'capacity',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLatReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLat()
		);
	}

	/**
	 * @test
	 */
	public function setLatForStringSetsLat() {
		$this->subject->setLat('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'lat',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLonReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getLon()
		);
	}

	/**
	 * @test
	 */
	public function setLonForIntegerSetsLon() {
		$this->subject->setLon(12);

		$this->assertAttributeEquals(
			12,
			'lon',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getDescription()
		);
	}

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription() {
		$this->subject->setDescription('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'description',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getImagesReturnsInitialValueForFileReference() {
		$this->assertEquals(
			NULL,
			$this->subject->getImages()
		);
	}

	/**
	 * @test
	 */
	public function setImagesForFileReferenceSetsImages() {
		$fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$this->subject->setImages($fileReferenceFixture);

		$this->assertAttributeEquals(
			$fileReferenceFixture,
			'images',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCategoryReturnsInitialValueForCategory() {
		$this->assertEquals(
			NULL,
			$this->subject->getCategory()
		);
	}

	/**
	 * @test
	 */
	public function setCategoryForCategorySetsCategory() {
		$categoryFixture = new \WSR\Myflat\Domain\Model\Category();
		$this->subject->setCategory($categoryFixture);

		$this->assertAttributeEquals(
			$categoryFixture,
			'category',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAttributeReturnsInitialValueForAttribute() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getAttribute()
		);
	}

	/**
	 * @test
	 */
	public function setAttributeForObjectStorageContainingAttributeSetsAttribute() {
		$attribute = new \WSR\Myflat\Domain\Model\Attribute();
		$objectStorageHoldingExactlyOneAttribute = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneAttribute->attach($attribute);
		$this->subject->setAttribute($objectStorageHoldingExactlyOneAttribute);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneAttribute,
			'attribute',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addAttributeToObjectStorageHoldingAttribute() {
		$attribute = new \WSR\Myflat\Domain\Model\Attribute();
		$attributeObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$attributeObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($attribute));
		$this->inject($this->subject, 'attribute', $attributeObjectStorageMock);

		$this->subject->addAttribute($attribute);
	}

	/**
	 * @test
	 */
	public function removeAttributeFromObjectStorageHoldingAttribute() {
		$attribute = new \WSR\Myflat\Domain\Model\Attribute();
		$attributeObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$attributeObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($attribute));
		$this->inject($this->subject, 'attribute', $attributeObjectStorageMock);

		$this->subject->removeAttribute($attribute);

	}

	/**
	 * @test
	 */
	public function getBookReturnsInitialValueForBook() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getBook()
		);
	}

	/**
	 * @test
	 */
	public function setBookForObjectStorageContainingBookSetsBook() {
		$book = new \WSR\Myflat\Domain\Model\Book();
		$objectStorageHoldingExactlyOneBook = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneBook->attach($book);
		$this->subject->setBook($objectStorageHoldingExactlyOneBook);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneBook,
			'book',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addBookToObjectStorageHoldingBook() {
		$book = new \WSR\Myflat\Domain\Model\Book();
		$bookObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$bookObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($book));
		$this->inject($this->subject, 'book', $bookObjectStorageMock);

		$this->subject->addBook($book);
	}

	/**
	 * @test
	 */
	public function removeBookFromObjectStorageHoldingBook() {
		$book = new \WSR\Myflat\Domain\Model\Book();
		$bookObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$bookObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($book));
		$this->inject($this->subject, 'book', $bookObjectStorageMock);

		$this->subject->removeBook($book);

	}
}
