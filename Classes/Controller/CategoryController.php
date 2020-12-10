<?php
namespace WSR\Myflat\Controller;

/**
 * This file is part of the "myflat" Extension for TYPO3 CMS.
 *
 * For the full license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

/**
 * CategoryController
 */
class CategoryController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * categoryRepository
	 * 
	 * @var \WSR\Myflat\Domain\Repository\CategoryRepository
	 * @TYPO3\CMS\Extbase\Annotation\Inject
	 */
	protected $categoryRepository = NULL;

	/**
	 * action list
	 * 
	 * @return void
	 */
	public function listAction() {
		$categories = $this->categoryRepository->findAll();
		$this->view->assign('categories', $categories);
	}

	/**
	 * action show
	 * 
	 * @param \WSR\Myflat\Domain\Model\Category $category
	 * @return void
	 */
	public function showAction(\WSR\Myflat\Domain\Model\Category $category) {
		$this->view->assign('category', $category);
	}

}