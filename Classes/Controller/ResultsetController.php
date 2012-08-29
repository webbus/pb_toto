<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 
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
 * Controller for the Resultset object
 */
class Tx_PbToto_Controller_ResultsetController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var boolean
	 */
	
	protected $isAdmin;
	
	protected $adminGroupId = '5';
	
	protected $tipPageId = 1065;

	/**
	 * @var object
	 */
	protected $user;
	
	
	/**
	 * @var Tx_PbToto_Domain_Repository_ResultsetRepository
	 */
	protected $resultsetRepository;

	/**
	 * @var Tx_PbToto_Domain_Repository_ResultRepository
	 */
	protected $resultRepository;

	/**
	 * @var Tx_PbToto_Domain_Repository_TipRepository
	 */
	protected $tipRepository;

	/**
	 * @var Tx_PbToto_Domain_Repository_TipsetRepository
	 */
	protected $tipsetRepository;	
	
	/** 
	 * @var $persistenceManager Tx_Extbase_Persistence_Manager 
	 * */
	
	protected $persistenceManager;	
	/**
	 * @param Tx_PbToto_Domain_Repository_ResultsetRepository $resultsetRepository
 	 * @return void
-	 */
	public function injectResultsetRepository(Tx_PbToto_Domain_Repository_ResultsetRepository $resultsetRepository) {
		$this->resultsetRepository = $resultsetRepository;
	}

	protected function initializeAction() {
		$this->persistenceManager = t3lib_div::makeInstance('Tx_Extbase_Persistence_Manager');
		$this->resultsetRepository = t3lib_div::makeInstance('Tx_PbToto_Domain_Repository_ResultsetRepository');
      $this->resultRepository = t3lib_div::makeInstance('Tx_PbToto_Domain_Repository_ResultRepository');
      $this->tipsetRepository = t3lib_div::makeInstance('Tx_PbToto_Domain_Repository_TipsetRepository');
      $this->tipRepository = t3lib_div::makeInstance('Tx_PbToto_Domain_Repository_TipRepository');
      $this->user =  $GLOBALS["TSFE"]->fe_user->user;
      $this->isAdmin = Tx_PbToto_Utils::isTotoAdmin($this->adminGroupId);
	}
	
	protected function initializeView() {
		$this->view->assign("now", time());
		$this->view->assign("user", $this->user);
		$this->view->assign("isAdmin", $this->isAdmin);
		$this->view->assign("tipPageId", $this->tipPageId);
		$this->view->assign ('isCommunication',sizeof($this->flashMessageContainer->getAllMessages())>0);
		
	}	

	/**
	 * Displays all Resultsets
	 *
	 * @return void
	 */
	public function listAction() {
		$resultsets = $this->resultsetRepository->findAll();
		$this->view->assign('resultsets', $resultsets);
	}

	//Muss da sein?
   public  function indexAction() {
   }

	public function showCurrentAction() {
		$resultset = $this->resultsetRepository->findCurrent();
		if($resultset) {
			$this->request->setArgument("resultset", $resultset->getUid());
			$this->forward("show");
		}
		else $this->forward("list");
		
	}
	
	public function showPreviewFirstAction() {
		$resultset = $this->resultsetRepository->findPreviewFirst();
		if($resultset instanceof Tx_PbToto_Domain_Model_Resultset) $this->request->setArgument("resultset", $resultset->getUid());
		else {
			$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('tx_pbtoto_message_resultset_no_resultset', $this->extensionName));
			$this->forward("list");
		}
		$this->forward("show");	
	}

	public function showPreviewSecondAction() {
		$resultset = $this->resultsetRepository->findPreviewSecond();
		if($resultset instanceof Tx_PbToto_Domain_Model_Resultset) $this->request->setArgument("resultset", $resultset->getUid());
		else {
			$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('tx_pbtoto_message_resultset_no_resultset', $this->extensionName));
			$this->forward("list");
		}
		$this->forward("show");
	}
	

	/**
	 * Displays a single Resultset
	 * @param Tx_PbToto_Domain_Model_Resultset $resultset
	 *
	 */
	public function showAction(Tx_PbToto_Domain_Model_Resultset $resultset) {
		if(! $resultset instanceof Tx_PbToto_Domain_Model_Resultset)
			$resultset = $this->resultRepository->findByUid($resultset);

		$resultset = $this->refresh($resultset);	
			
		$tipsets = $this->tipsetRepository->findByResultset($resultset->getUid());
		$userArray = array();
		foreach ($tipsets as $tipset) {
			$tmp = Tx_PbToto_Utils::getFrontendUser($tipset->getFeUser());
			if($tmp) {
				$userArray[$tmp["uid"]] = $tmp;
			}
		}	
		
		$this->view->assign("userArray", $userArray);
		$this->view->assign('tipsets', $tipsets);
		$this->view->assign('resultset', $resultset);
	}

	/**
	 * Refresh the resultset if it is not yet finished
	 * @param Tx_PbToto_Domain_Model_Resultset $resultset
	 * return array $errors in case of error
	 */
	
	protected function refresh(Tx_PbToto_Domain_Model_Resultset $resultset) {
		if(!$resultset->getIsFinished()) {
			$soap = new Tx_PbToto_Soap();
			if($soap->errors) {
				$this->flashMessageContainer->flush();
				$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('tx_pbtoto_message_no_internet', $this->extensionName));
				return $soap->errors;
			}
			
			foreach($resultset->getResult() as $singleResult) {
				if(!$singleResult->getMatchIsFinished()) {
					if($match = $soap->getMatchByMatchID($singleResult->getMatchID())) {
						if($match->matchIsFinished == '1') {
							$singleResult->setPointsTeam1($match->pointsTeam1);
							$singleResult->setPointsTeam2($match->pointsTeam2);
							$trend = ($match->pointsTeam1 > $match->pointsTeam2) ? 1 : 2;
							$trend = ($match->pointsTeam1 == $match->pointsTeam2) ? 0 : $trend;
							$singleResult->setTrend($trend);
							$singleResult->setMatchIsFinished(1);	
						}
					} 
				}
			}
			
			$isFinished = true;
			foreach($resultset->getResult() as $singleResult) {
				if(!$singleResult->getMatchIsFinished()) {
					$isFinished = false;
				}
			}
			if($isFinished) $resultset->setIsFinished(1);
		
			$this->resultsetRepository->update($resultset);
			$this->persistenceManager->persistAll();
		
		}
		return $resultset;
	} 
	
	
	/**
	 * Displays a form for creating a new  Resultset
	 *
	 *
	 * @param Tx_PbToto_Domain_Model_Resultset $resultset a fresh Resultset object which has not yet been added to the repository
	 * @return void
	 * @dontvalidate $resultset
	 */
	public function newAction(Tx_PbToto_Domain_Model_Resultset $resultset = NULL) {
		$this->view->assign('resultset', $resultset);
	}


	/**
	 * Creates a new Resultset and forwards to the list action.
	 *
	 * @param Tx_PbToto_Domain_Model_Resultset $resultset a fresh Resultset object which has not yet been added to the repository
	 * @return void
	 */
	public function createAction(Tx_PbToto_Domain_Model_Resultset $resultset) {
		$begin_tmp = explode('.', $resultset->getBegin());
		$resultset->setBegin(mktime(0,0,0,$begin_tmp[1],$begin_tmp[0],$begin_tmp[2])); 
		$end_tmp = explode('.', $resultset->getEnd());
		$resultset->setEnd(mktime(0,0,0,$end_tmp[1],$end_tmp[0],$end_tmp[2])); 
		
		$this->resultsetRepository->add($resultset);
		$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('tx_pbtoto_message_resultset_create', $this->extensionName));
			
		$this->forward('edit');
	}


	/**
	 * Displays a form for editing an existing Resultset
	 *
	 * @param Tx_PbToto_Domain_Model_Resultset $resultset the Resultset to display
	 * @return string A form to edit a Resultset 
	 */
	public function editAction(Tx_PbToto_Domain_Model_Resultset $resultset=NULL) {
		$this->view->assign('resultset', $resultset);
	}


	/**
	 * Updates an existing Resultset and forwards to the list action afterwards.
	 *
	 * @param Tx_PbToto_Domain_Model_Resultset $resultset the Resultset to display
	 * @param array $result
	 */
	public function updateAction(Tx_PbToto_Domain_Model_Resultset $resultset, array $result = NULL) {
		if($result != NULL) 
			$this->propertyMapper->map(
	     		 array('result'), array('result' => $result), $resultset
	  		);
	  	else $resultset->setResult(new Tx_Extbase_Persistence_ObjectStorage());
		
  		$begin_tmp = explode('.', $resultset->getBegin());
		$resultset->setBegin(mktime(0,0,0,$begin_tmp[1],$begin_tmp[0],$begin_tmp[2])); 
		$end_tmp = explode('.', $resultset->getEnd());
		$resultset->setEnd(mktime(0,0,0,$end_tmp[1],$end_tmp[0],$end_tmp[2])); 
		
  		$this->resultsetRepository->update($resultset);
	
		$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('tx_pbtoto_message_resultset_update', $this->extensionName));
		$this->redirect('list');
	}


			/**
	 * Deletes an existing Resultset
	 *
	 * @param Tx_PbToto_Domain_Model_Resultset $resultset the Resultset to be deleted
	 * @return void
	 */
	public function deleteAction(Tx_PbToto_Domain_Model_Resultset $resultset) {
		$this->resultsetRepository->remove($resultset);
		$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('tx_pbtoto_message_resultset_delete', $this->extensionName));
		$this->redirect('list');
	}
	
	public function x($output) {
		echo '<pre>'.print_r($output,1).'</pre>';
		die();
	}

}
?>