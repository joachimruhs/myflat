<?php
namespace WSR\Myflat\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 
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
