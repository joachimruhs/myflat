<?php
namespace WSR\Myflat\Domain\Model;


/**
 * This file is part of the "myflat" Extension for TYPO3 CMS.
 *
 * For the full license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

/**
 * Flat
 */
class Flat extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * name
	 * 
	 * @var string
	 */
	protected $name = '';

	/**
	 * address
	 * 
	 * @var string
	 */
	protected $address = '';

	/**
	 * zipcode
	 * 
	 * @var string
	 */
	protected $zipcode = '';

	/**
	 * city
	 * 
	 * @var string
	 */
	protected $city = '';

	/**
	 * country
	 * 
	 * @var string
	 */
	protected $country = '';

	/**
	 * capacity
	 * 
	 * @var integer
	 */
	protected $capacity = 0;

	/**
	 * lat
	 * 
	 * @var string
	 */
	protected $lat = '';

	/**
	 * lon
	 * 
	 * @var string
	 */
	protected $lon = '';

	/**
	 * description
	 * 
	 * @var string
	 */
	protected $description = '';

        /**
         * Images
         * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
         */
        protected $images;
	

	/**
	* Returns the images
	*
	* @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
	*/
	public function getImages() {
	   return $this->images;
	}
   
	/**
	* Sets the images
	*
	* @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
	* @return void
	*/
	public function setImages(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $images) {
	   $this->images = $images;
	}


	
	/**
	 * category
	 * 
	 * @var \WSR\Myflat\Domain\Model\Category
	 */
	protected $category = NULL;

	/**
	 * attribute
	 * 
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\WSR\Myflat\Domain\Model\Attribute>
	 */
	protected $attribute = NULL;

	/**
	 * book
	 * 
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\WSR\Myflat\Domain\Model\Book>
	 * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
	 */
	protected $book = NULL;

	/**
	 * __construct
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 * 
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->attribute = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->book = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the name
	 * 
	 * @return string $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the name
	 * 
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Returns the address
	 * 
	 * @return string $address
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * Sets the address
	 * 
	 * @param string $address
	 * @return void
	 */
	public function setAddress($address) {
		$this->address = $address;
	}

	/**
	 * Returns the zipcode
	 * 
	 * @return string $zipcode
	 */
	public function getZipcode() {
		return $this->zipcode;
	}

	/**
	 * Sets the zipcode
	 * 
	 * @param string $zipcode
	 * @return void
	 */
	public function setZipcode($zipcode) {
		$this->zipcode = $zipcode;
	}

	/**
	 * Returns the city
	 * 
	 * @return string $city
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * Sets the city
	 * 
	 * @param string $city
	 * @return void
	 */
	public function setCity($city) {
		$this->city = $city;
	}

	/**
	 * Returns the country
	 * 
	 * @return string $country
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * Sets the country
	 * 
	 * @param string $country
	 * @return void
	 */
	public function setCountry($country) {
		$this->country = $country;
	}

	/**
	 * Returns the capacity
	 * 
	 * @return integer $capacity
	 */
	public function getCapacity() {
		return $this->capacity;
	}

	/**
	 * Sets the capacity
	 * 
	 * @param integer $capacity
	 * @return void
	 */
	public function setCapacity($capacity) {
		$this->capacity = $capacity;
	}

	/**
	 * Returns the lat
	 * 
	 * @return string $lat
	 */
	public function getLat() {
		return $this->lat;
	}

	/**
	 * Sets the lat
	 * 
	 * @param string $lat
	 * @return void
	 */
	public function setLat($lat) {
		$this->lat = $lat;
	}

	/**
	 * Returns the lon
	 * 
	 * @return integer $lon
	 */
	public function getLon() {
		return $this->lon;
	}

	/**
	 * Sets the lon
	 * 
	 * @param integer $lon
	 * @return void
	 */
	public function setLon($lon) {
		$this->lon = $lon;
	}

	/**
	 * Returns the description
	 * 
	 * @return string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 * 
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}


	/**
	 * Returns the category
	 * 
	 * @return \WSR\Myflat\Domain\Model\Category $category
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * Sets the category
	 * 
	 * @param \WSR\Myflat\Domain\Model\Category $category
	 * @return void
	 */
	public function setCategory(\WSR\Myflat\Domain\Model\Category $category) {
		$this->category = $category;
	}

	/**
	 * Adds a Attribute
	 * 
	 * @param \WSR\Myflat\Domain\Model\Attribute $attribute
	 * @return void
	 */
	public function addAttribute(\WSR\Myflat\Domain\Model\Attribute $attribute) {
		$this->attribute->attach($attribute);
	}

	/**
	 * Removes a Attribute
	 * 
	 * @param \WSR\Myflat\Domain\Model\Attribute $attributeToRemove The Attribute to be removed
	 * @return void
	 */
	public function removeAttribute(\WSR\Myflat\Domain\Model\Attribute $attributeToRemove) {
		$this->attribute->detach($attributeToRemove);
	}

	/**
	 * Returns the attribute
	 * 
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\WSR\Myflat\Domain\Model\Attribute> $attribute
	 */
	public function getAttribute() {
		return $this->attribute;
	}

	/**
	 * Sets the attribute
	 * 
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\WSR\Myflat\Domain\Model\Attribute> $attribute
	 * @return void
	 */
	public function setAttribute(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $attribute) {
		$this->attribute = $attribute;
	}

	/**
	 * Adds a Book
	 * 
	 * @param \WSR\Myflat\Domain\Model\Book $book
	 * @return void
	 */
	public function addBook(\WSR\Myflat\Domain\Model\Book $book) {
		$this->book->attach($book);
	}

	/**
	 * Removes a Book
	 * 
	 * @param \WSR\Myflat\Domain\Model\Book $bookToRemove The Book to be removed
	 * @return void
	 */
	public function removeBook(\WSR\Myflat\Domain\Model\Book $bookToRemove) {
		$this->book->detach($bookToRemove);
	}

	/**
	 * Returns the book
	 * 
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\WSR\Myflat\Domain\Model\Book> $book
	 */
	public function getBook() {
		return $this->book;
	}

	/**
	 * Sets the book
	 * 
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\WSR\Myflat\Domain\Model\Book> $book
	 * @return void
	 */
	public function setBook(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $book) {
		$this->book = $book;
	}

}