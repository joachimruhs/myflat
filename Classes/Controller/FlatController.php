<?php
namespace WSR\Myflat\Controller;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2017 - 2020
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
 * FlatController
 */
class FlatController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	 public function initializeObject1() {
      	$configuration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		$this->conf['storagePid'] = $configuration['persistence']['storagePid'];

//$querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
//$querySettings->setRespectStoragePage(FALSE);
// $querySettings->setStoragePageIds(array(1, 26, 989));
     }

	/**
	 * flatRepository
	 * 
	 * @var \WSR\Myflat\Domain\Repository\FlatRepository
	 */
	protected $flatRepository = NULL;


    /**
     * Inject a flatRepository to enable DI
     *
     * @param \WSR\Myflat\Domain\Repository\FlatRepository $feUserRepository
     * @return void
     */
    public function injectFlatRepository(\WSR\Myflat\Domain\Repository\FlatRepository $flatRepository) {
        $this->flatRepository = $flatRepository;
    }

	/**
	 * action list
	 * 
	 * @return void
	 */
	public function listAction() {

		$this->_GP = $this->request->getArguments();

		$flats = $this->flatRepository->findByUidAndLang(1, $this->conf['storagePid']);
		
		//\TYPO3\CMS\Core\Utility\DebugUtility::debug($flats, 'Debug: ' . __FILE__ . ' in Line: ' . __LINE__);

		// if there is only one flat switch to multirowcalendar
		if (count($flats) == 1) {
			$this->_GP['flatUid'] = $flats[0]->getUid();			
			$this->forward("multirowcalendar", NULL, NULL, $this->_GP);
			}

		$this->view->assign('Lvar', $GLOBALS['TSFE']->config['config']['sys_language_uid']);
		$this->view->assign('flats', $flats);
	}

	/**
	 * action show
	 * 
	 * @param \WSR\Myflat\Domain\Model\Flat $flat
	 * @return void
	 */
	public function showAction(\WSR\Myflat\Domain\Model\Flat $flat) {
		$this->view->assign('flat', $flat);
	}

	/**
	 * action availabilityform
	 * 
	 * @return void
	 */
	public function availabilityformAction() {
	    $this->_GP = \TYPO3\CMS\Core\Utility\GeneralUtility::_POST();
	    $this->view->assign('_GP', $this->_GP['tx_myflat_availabilitycheck']);
	}
	


	/**
	 * action availabilitycheck
	 * 
	 * @return void
	 */
	public function availabilitycheckAction() {
		$this->_GP = $this->request->getArguments();
		if (!$this->_GP['arrival'] || !$this->_GP['departure']) return;

		list($day, $month, $year) = explode('.', $this->_GP['arrival']);
		$arrival = mktime(0,0,0,$month, $day, $year);
		list($day, $month, $year) = explode('.', $this->_GP['departure']);
		$departure = mktime(0,0,0,$month, $day, $year);


		if (($arrival >= $departure)) {
			$this->flashMessage('Extension: myflat',
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('departureBeforeArrival', 'myflat'),
				\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
//			$this->forward("availabilityform", NULL, NULL, $this->request->getArguments());
			return;
			//forward  ($actionName, $controllerName = null, $extensionName = null, array  $arguments = null)  

		}

		$capacity = $this->_GP['capacity'];

		$flats = $this->flatRepository->findAllOverwrite($capacity);
		for ($i = 0; $i < count($flats); $i++) {
			$uid = $flats[$i]['uid'];
			// now get the available flats		
			$avail = $this->flatRepository->checkAvailability($uid, $arrival, $departure);
			if ($avail) {
				$availableFlats[] = $flats[$i];
			}
		}


		$this->view->assign('year', $year);		

		$this->view->assign('arrival', $this->_GP['arrival']);		
		$this->view->assign('departure', $this->_GP['departure']);		
		$this->view->assign('flats', $availableFlats);
	}
	
	
	
	/**
	 * action multirowcalendar
	 * 
	 * @return void
	 */
	public function multirowcalendarAction() {
		$this->_GP = $this->request->getArguments();

		// this is used when called by flat list
		if (!$this->_GP['year']) $this->_GP['year'] = date('Y', time());
		
		$flat = $this->flatRepository->findByUid($this->_GP['flatUid']);

		$months = array(\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('january', 'myflat'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('februar', 'myflat'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('march', 'myflat'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('april', 'myflat'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('may', 'myflat'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('june', 'myflat'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('july', 'myflat'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('august', 'myflat'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('september', 'myflat'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('october', 'myflat'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('november', 'myflat'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('december', 'myflat'));

		$days = array(\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('mo', 'myflat'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tu', 'myflat'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('we', 'myflat'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('th', 'myflat'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('fr', 'myflat'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('sa', 'myflat'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('su', 'myflat'));


		$this->settings['monthLabels'] = $months;
		$this->settings['dayLabels'] = $days;
		$this->view->assign('settings', $this->settings);

		$years = array (
			(date('Y', time()) - 1),
			(date('Y', time())),
			(date('Y', time()) + 1)
		);
		
		$this->view->assign('years', $years);


		$this->view->assign('year', $this->_GP['year']);
		$this->view->assign('flat', $flat);
		
	}

	/**
	 * Flash a message
	 *
	 * @param string title 
	 * @param string message
	 * @param string $severity
	 * 
	 * @return void
	 */
	private function flashMessage($title, $message, $severity = \TYPO3\CMS\Core\Messaging\FlashMessage::WARNING) {
		$this->addFlashMessage(
			$message,
			$title,
			$severity,
			$storeInSession = TRUE
		);
	}	
	
	
}