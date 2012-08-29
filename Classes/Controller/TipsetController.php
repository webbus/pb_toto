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
 * Controller for the Tipset object
 */
class Tx_PbToto_Controller_TipsetController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var object
	 */
	protected $user;

	
	protected $tipPageId = 1065;
	
	/**
	 * 
	 * @var array
	 */
	protected $exceptionActions = array("showTableAction","errorAction");
	
	protected $multiTipsets;
	
	/**
	 * 
	 * Enter description here ...
	 * @var Tx_PbToto_Domain_Model_Resultset
	 */
	
	protected $currentResultset;
	
	/**
	 * @var int $parentTotoGroupId
	 */
	protected $parentTotoGroupId = 4;	

	/**
	 * @var int $userTotoGroupId
	 */
	protected $userTotoGroupId;	
	
	
	protected $adminGroupId = 5;
	
	/**
	 * @var boolean
	 */
	
	protected $isAdmin;
	
	/**
	 * @var Tx_PbToto_Domain_Repository_TipRepository
	 */
	protected $tipRepository;

	/**
	 * @var Tx_PbToto_Domain_Repository_TipsetRepository
	 */
	protected $tipsetRepository;
	
	/**
	 * @var Tx_PbToto_Domain_Repository_ResultsetRepository
	 */
	protected $resultsetRepository;

	/**
	 * @var Tx_PbToto_Domain_Repository_ResultRepository
	 */
	protected $resultRepository;
		
	/** 
	 * @var $persistenceManager Tx_Extbase_Persistence_Manager 
	 * */
	
	protected $persistenceManager;		
	
	

	/**
	 * @param Tx_PbToto_Domain_Repository_TipRepository $tipRepository
 	 * @return void
-	 */
	public function injectTipsetRepository(Tx_PbToto_Domain_Repository_TipsetRepository $tipsetRepository) {
		$this->tipsetRepository = $tipsetRepository;
	}	
	
	protected function initializeAction() {
      $this->persistenceManager = t3lib_div::makeInstance('Tx_Extbase_Persistence_Manager');
      $this->resultsetRepository = t3lib_div::makeInstance('Tx_PbToto_Domain_Repository_ResultsetRepository');
      $this->resultRepository = t3lib_div::makeInstance('Tx_PbToto_Domain_Repository_ResultRepository');
      $this->tipsetRepository = t3lib_div::makeInstance('Tx_PbToto_Domain_Repository_TipsetRepository');
      $this->tipRepository = t3lib_div::makeInstance('Tx_PbToto_Domain_Repository_TipRepository');
      $this->isAdmin = Tx_PbToto_Utils::isTotoAdmin($this->adminGroupId);
      $this->user =  $GLOBALS["TSFE"]->fe_user->user;
      if($this->user["uid"]=="") {
      	$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('tx_pbtoto_message_no_login', $this->extensionName));
      	$this->forward("error");
      }
      $this->userTotoGroupId = Tx_PbToto_Utils::getUserTotoGroupId($this->user["uid"],$this->parentTotoGroupId);
      if(!$this->userTotoGroupId) {
      	$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('tx_pbtoto_message_no_rights', $this->extensionName));
      	$this->forward("error");
      }
      if($this->request->hasArgument("resultset") && $this->request->getArgument("resultset") != "") {
      	$this->currentResultset =  $this->resultsetRepository->findByUid($this->request->getArgument("resultset"));
       }
      else {
      	$tmp = $_POST["tx_pbtoto_pi1"];
      	$tmp2= $tmp["tipset"];
      	if($tmp2["resultset"]) {
      		$this->currentResultset =  $this->resultsetRepository->findByUid($tmp2["resultset"]);
      	}
       	else if(!in_array($this->actionMethodName,$this->exceptionActions)){
      		$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('tx_pbtoto_message_resultset_no_resultset', $this->extensionName));
      		$this->forward("error");
      	}
      }
		if(!in_array($this->actionMethodName,$this->exceptionActions))
			$this->request->setArgument("resultset", $this->currentResultset->getUid()); 
	
	}	
	
	protected function initializeView() {
		
		if(!in_array($this->actionMethodName,$this->exceptionActions)) { 	
			$this->setMultiTipsets();
			$results = $this->resultRepository->findByResultset($this->currentResultset->getUid());
			$tipsets = $this->tipsetRepository->findByUserAndResultset($this->user["uid"],$this->currentResultset->getUid());
		
			$isTipsets = false;
			foreach($tipsets as $tipset) $isTipsets = true;		
			if(!$isTipsets && $this->actionMethodName != "newAction") $this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('tx_pbtoto_message_tipset_no_tipset', $this->extensionName));
			
		}
		
		$this->view->assign("isAdmin", $this->isAdmin);
		$this->view->assign("resultset",  $this->currentResultset);
		$this->view->assign('results',$results );
		$this->view->assign('tipsets', $tipsets);
		$this->view->assign ('isCommunication',sizeof($this->flashMessageContainer->getAllMessages())>0);
		$this->view->assign('multiTipsets',$this->multiTipsets );
		
		$this->view->assign("tipPageId", $this->tipPageId);
		

	}	
	
	/**
	 * Noch gebraucht? 
	 */
	public function errorAction() {

	}
	
	
	/**
	 * Zeigt die Tabelle für die Totogruppe des Benutzers
	 */
	public function showTableAction() {
		$resultsets = $this->resultsetRepository->findByIsFinished(1);
		$users = Tx_PbToto_Utils::getUsersByTotoGroupId($this->userTotoGroupId);
		foreach($resultsets as $resultset) {
			
			$tipsets = $this->tipsetRepository->findByUsersAndResultset($users,$resultset->getUid());
			foreach($tipsets as $tipset) {
				$points = 0;
				$tips = 0;
				foreach($tipset->getTip() as $singleTip) {
					if($singleTip->getResult()->getMatchIsFinished()) {
						$tips++;
						if($singleTip->getTrend() == $singleTip->getResult()->getTrend()) {
							$points++;
						}
					}
				}
				//Initialisieren
				if(!$users[$tipset->getFeUser()]["points"]) $users[$tipset->getFeUser()]["points"] = 0;
				if(!$users[$tipset->getFeUser()]["tips"]) $users[$tipset->getFeUser()]["tips"] = 0;
				
				$users[$tipset->getFeUser()]["points"] += $points;
				$users[$tipset->getFeUser()]["tips"] += $tips;
			}
		}

	  asort($users, "Tx_PbToto_Utils::sortUsers");
     $this->view->assign("users", $users);

	}
	
	
	/**
	 * MultiTip
	 * @param array $storage
	 */
	
	public function multiTipsetsUpdateAction(array $storage=NULL) {
	   foreach ($storage as $key => $value) {
			$tip = $this->tipRepository->findByUid($key);
			$tip->setTrend($value["trend"]);
		}
		$this->persistenceManager->persistAll();
		$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('tx_pbtoto_message_tipset_update', $this->extensionName));

		$this->forward("list");
	}		
	
	
	/**
	 * Displays a single Tipset
	 *
	<td><f:link.action action="edit" arguments="{resultset : resultset}">Edit</f:link.action></td>
	 * @return string The rendered view
	 */
	public function showAction(Tx_PbToto_Domain_Model_Tipset $tipset) {
		$this->view->assign('tipset', $tipset);
	}


	public function listAction(){
		
		
	}
	
	/**
	 * Displays a form for creating a new  Tipset
	 *
	 * @param Tx_PbToto_Domain_Model_Tipset $tipset a fresh Tipset object which has not yet been added to the repository
	 * @return void
	 * @dontvalidate $tipset
	 */
	public function newAction(Tx_PbToto_Domain_Model_Tipset $tipset = NULL) {

		if(is_null) $tipset = new Tx_PbToto_Domain_Model_Tipset();

		$tipset->setResultset($this->currentResultset->getUid());
		$resultset =  $this->resultsetRepository->findByUid($this->currentResultset->getUid());

		$this->view->assign('tipset', $tipset);
	}


	/**
	 * Creates a new Tipset and forwards to the list action.
	 *
	 * @param Tx_PbToto_Domain_Model_Tipset $tipset a fresh Tipset object which has not yet been added to the repository
	 * @return void
	 */
	public function createAction(Tx_PbToto_Domain_Model_Tipset $tipset=NULL) {
		$tipset->setFeUser($GLOBALS["TSFE"]->fe_user->user["uid"]);
		$this->tipsetRepository->add($tipset);
		$this->persistenceManager->persistAll();
		$this->flashMessageContainer->flush();
		$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('tx_pbtoto_message_tipset_create', $this->extensionName));
		$this->forward('list');
		
	}

	
	/**
	 * Displays a form for editing an existing Tipset
	 *
	 * @param Tx_PbToto_Domain_Model_Tipset $tipset the Tipset to display
	 * @return string A form to edit a Tipset 
	 */
	public function editAction(Tx_PbToto_Domain_Model_Tipset $tipset) {
		$this->view->assign('tipset', $tipset);

	}


	/**
	 * Updates an existing Tipset and forwards to the list action afterwards.
	 *
	 * @param Tx_PbToto_Domain_Model_Tipset $tipset the Tipset to display
	 */
	public function updateAction(Tx_PbToto_Domain_Model_Tipset $tipset) {
		
		$this->tipsetRepository->update($tipset);
		$this->persistenceManager->persistAll();
		$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('tx_pbtoto_message_tipset_update', $this->extensionName));
		
		$this->forward('list');

	}


			/**
	 * Deletes an existing Tipset
	 *
	 * @param Tx_PbToto_Domain_Model_Tipset $tipset the Tipset to be deleted
	 * @return void
	 */
	public function deleteAction(Tx_PbToto_Domain_Model_Tipset $tipset) {
		$this->tipsetRepository->remove($tipset);
		$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('tx_pbtoto_message_tipset_delete', $this->extensionName));
		$this->persistenceManager->persistAll();

		$this->forward('list');		
		
	}

	protected function sortUsers($a,$b) {die('test');return $a['points'] > $b['points'];}
	

	/**
	 * Displays all Tipsets

	 * @return void
	 */
	protected function setMultiTipsets() {

		$tipsets = $this->tipsetRepository->findByUserAndResultset($this->user["uid"],$this->currentResultset->getUid());
		$results = $this->resultRepository->findByResultset($this->currentResultset->getUid());
				
		foreach($tipsets as $tipset) {
			
			//alle Tips anlegen
			foreach($results as $result) {
				$isResult = false;
				$tips = $tipset->getTip();
				foreach ($tips as $tip){
					if ($tip instanceof Tx_PbToto_Domain_Model_Tip && $tip->getResult() instanceof Tx_PbToto_Domain_Model_Result) {
						if($tip->getResult()->getUid() == $result->getUid()) {
							$isResult = true;
							break;
						}
					}
				}
				if(!$isResult) {
					$newTip = new Tx_PbToto_Domain_Model_Tip();
					$newTip->setResult($result->getUid());
					$tipset->addTip($newTip);
				}
			}
		}
		
		$this->persistenceManager->persistAll();

		$storage = new Tx_Extbase_Persistence_ObjectStorage();
		foreach($tipsets as $tipset) $storage->attach($tipset);
		
		$this->multiTipsets = new Tx_PbToto_Domain_Model_MultiTipsets();
		$this->multiTipsets->setStorage($storage);
	}	
	
	
	
	protected function x($output) {
	echo '<pre>'.print_r($output,1).'</pre>';
	die();

}
	

}
?>