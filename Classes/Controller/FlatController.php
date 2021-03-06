<?php
namespace WSR\Myflat\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This file is part of the "myflat" Extension for TYPO3 CMS.
 *
 * For the full license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

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
     * @param \WSR\Myflat\Domain\Repository\FlatRepository $flatRepository
     * @return void
     */
    public function injectFlatRepository(\WSR\Myflat\Domain\Repository\FlatRepository $flatRepository) {
        $this->flatRepository = $flatRepository;
    }

    /**
     * Inject a bookRepository
     *
     * @param \WSR\Myflat\Domain\Repository\BookRepository $bookRepository
     * @return void
     */
    public function injectBookRepository(\WSR\Myflat\Domain\Repository\BookRepository $bookRepository) {
        $this->bookRepository = $bookRepository;
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

		$context = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Context\Context::class);
		$sys_language_uid = $context->getPropertyFromAspect('language', 'id'); 
		$this->view->assign('Lvar', $sys_language_uid);

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
			$avail = $this->bookRepository->checkAvailability($uid, $arrival, $departure);
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
			(date('Y', time())) + 0,
			(date('Y', time()) + 1)
		);
		
		$this->view->assign('years', $years);
		$this->view->assign('year', intval($this->_GP['year']));
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