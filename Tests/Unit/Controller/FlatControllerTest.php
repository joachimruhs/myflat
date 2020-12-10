<?php
namespace WSR\Myflat\Tests\Unit\Controller;

/**
 * This file is part of the "myflat" Extension for TYPO3 CMS.
 *
 * For the full license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

/**
 * Test case for class WSR\Myflat\Controller\FlatController.
 *
 */
class FlatControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \WSR\Myflat\Controller\FlatController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('WSR\\Myflat\\Controller\\FlatController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllFlatsFromRepositoryAndAssignsThemToView() {

		$allFlats = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$flatRepository = $this->getMock('WSR\\Myflat\\Domain\\Repository\\FlatRepository', array('findAll'), array(), '', FALSE);
		$flatRepository->expects($this->once())->method('findAll')->will($this->returnValue($allFlats));
		$this->inject($this->subject, 'flatRepository', $flatRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('flats', $allFlats);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenFlatToView() {
		$flat = new \WSR\Myflat\Domain\Model\Flat();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('flat', $flat);

		$this->subject->showAction($flat);
	}
}
