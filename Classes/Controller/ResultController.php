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
 * Controller for the Result object
 */
class Tx_PbToto_Controller_ResultController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var Tx_PbToto_Domain_Repository_ResultRepository
	 */
	
	protected $resultRepository;

	/** 
	 * @var $persistenceManager Tx_Extbase_Persistence_Manager 
	 * */
	
	protected $persistenceManager;

	/**
	 * 
	 * Enter description here ...
	 * @param Tx_PbToto_Soap
	 */
	protected $soap;
	
	
	public function injectResultRepository(Tx_PbToto_Domain_Repository_ResultRepository $resultRepository) {
		$this->resultRepository = $resultRepository;
	}

	protected function initializeAction() {
		$this->persistenceManager = t3lib_div::makeInstance('Tx_Extbase_Persistence_Manager');
		$this->soap = new Tx_PbToto_Soap();
		$this->flashMessageContainer->flush();
		if($this->soap->errors) {
			$tmp = $_GET["tx_pbtoto_pi1"];
			$tmp["resultsetId"];
			$arguments = array (
				"resultset" =>$tmp["resultsetId"],
				"action" => "edit",
				"controller" => "Resultset"
			);
			$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('tx_pbtoto_message_no_internet', $this->extensionName));	
			$this->redirect ("edit","Resultset","PbToto",$arguments);
		}		
	}



	/**
	 * Displays a form for creating a new  Result
	 *
	 * @param Tx_PbToto_Domain_Model_Result $newResult the Result to display
	 * @return void
	 * @dontvalidate $newResult
	 *
	 */
	public function newAction(Tx_PbToto_Domain_Model_Result $newResult = NULL ) {

		if(is_null($newResult))  {
				$newResult = new Tx_PbToto_Domain_Model_Result();
				$tmp_resultset = $_GET["tx_pbtoto_pi1"];
				$newResult->setResultset($tmp_resultset["resultsetId"]); 
				$newResult->setLeagueSeason(date('Y'));
				$newResult->setLeagueShortcut("bl2");
				$newResult->setGroupOrderID($this->soap->getCurrentGroupOrderID("bl2"));
			}
			$this->soap->setLeagueSaison($newResult->getLeagueSeason());
			$this->soap->setLeagueShortcut($newResult->getleagueShortcut());
			$this->soap->setGroupOrderID($newResult->getGroupOrderID());
			
			$this->view->assign("groupOrders", $this->soap->getSelectionGroupOrders());		
			$this->view->assign("leagueSeasons", $this->soap->getSelectionYears());
			$this->view->assign("leagueShortcuts", $this->soap->getSelectionLeagueShortcuts());
			$this->view->assign("matches", $this->soap->getSelectionMatches());
	
			$this->view->assign('newResult', $newResult);
	}

	/**
	 * Creates a new Result and forwards to the list action.
	 * @dontvalidate $newResult
	 * @param Tx_PbToto_Domain_Model_Result $newResult a fresh Result object which has not yet been added to the repository
	 * 
	 */
	public function createAction(Tx_PbToto_Domain_Model_Result $newResult=NULL) {

		if(!$newResult->getMatchID() || !$newResult->getResultset()) $this->forward("new","Result","PbToto");
		
		$match = $this->soap->getMatchByMatchID($newResult->getMatchID());

		$newResult->setIconUrlTeam1($match->iconUrlTeam1);
		$newResult->setIconUrlTeam2($match->iconUrlTeam2);
		$newResult->setNameTeam1($match->nameTeam1);
		$newResult->setNameTeam2($match->nameTeam2);
		$newResult->setPointsTeam1('');
		$newResult->setPointsTeam2('');
		$newResult->setMatchIsFinished(false);
		 
		$this->resultRepository->add($newResult);
		$newResult->getResultset()->addResult($newResult);
			
		$arguments = array (
			"resultset" =>$newResult->getResultset()->getUid(),
			"action" =>edit,
			"controller" => "Resultset"
		);
			
		$this->persistenceManager->persistAll();
		$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('tx_pbtoto_message_result_create', $this->extensionName));		
		$this->redirect ("edit","Resultset","PbToto",$arguments);

}

	/**
	 * Displays a form for editing an existing Result
	 *
	 * @param Tx_PbToto_Domain_Model_Result $result the Result to display
	 * @return string A form to edit a Result 
	 */
	public function editAction(Tx_PbToto_Domain_Model_Result $result) {
		$this->view->assign('result', $result);
	}


	/**
	 * Deletes an existing Result
	 *
	 * @param Tx_PbToto_Domain_Model_Result $result the Result to be deleted
	 * @return void
	 */
	public function deleteAction(Tx_PbToto_Domain_Model_Result $result) {
		$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('tx_pbtoto_message_result_delete', $this->extensionName));
		
		$arguments = array (
			"resultset" =>$result->getResultset()->getUid(),
			"action" =>edit,
			"controller" => "Resultset"
		);
		$result->getResultset()->removeResult($result);
		$this->resultRepository->remove($result);
		$this->persistenceManager->persistAll();

		$this->redirect ("edit","Resultset","PbToto",$arguments);		
	}

	
	public function x($output) {
		echo '<pre>'.print_r($output,1).'</pre>';
		die();
		
	}

}
?>