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
 * Controller for the Tip object
 */
class Tx_PbToto_Controller_TipController extends Tx_Extbase_MVC_Controller_ActionController {

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
	public function injectTipRepository(Tx_PbToto_Domain_Repository_TipRepository $tipRepository) {
		$this->tipRepository = $tipRepository;
	}	
	
	protected function initializeAction() {
      $this->persistenceManager = t3lib_div::makeInstance('Tx_Extbase_Persistence_Manager');
      $this->resultsetRepository = t3lib_div::makeInstance('Tx_PbToto_Domain_Repository_ResultsetRepository');
      $this->resultRepository = t3lib_div::makeInstance('Tx_PbToto_Domain_Repository_ResultRepository');
      $this->tipsetRepository = t3lib_div::makeInstance('Tx_PbToto_Domain_Repository_TipsetRepository');
      $this->tipRepository = t3lib_div::makeInstance('Tx_PbToto_Domain_Repository_TipRepository');
	
	}
	

	/**
	 * Displays all Tips
	 *
	 * @return void
	 */
	public function listAction() {
		$tmp = $_GET["tx_pbtoto_pi1"];
		$resultset = $tmp["resultset"];
		$user = $GLOBALS["TSFE"]->fe_user->user["uid"];
		
			$resultsets = $this->resultsetRepository->findAll();
		$this->x($resultsets);
		
		$result = $this->tipRepository->findByUserAndResultset($user, $resultset);
		//$result = $this->tipsetRepository->findAll();

		die();
		
		$tips = $this->tipRepository->findAll();
		$this->view->assign('tips', $tips);
	}


	/**
	 * Displays a single Tip
	 *
	 * @param Tx_PbToto_Domain_Model_Tip $tip the Tip to display
	 * @return string The rendered view
	 */
	public function showAction(Tx_PbToto_Domain_Model_Tip $tip) {
		$this->view->assign('tip', $tip);
	}


	/**
	 * Displays a form for creating a new  Tip
	 *
	 * @param Tx_PbToto_Domain_Model_Tip $newTip a fresh Tip object which has not yet been added to the repository
	 * @return void
	 * @dontvalidate $newTip
	 */
	public function newAction(Tx_PbToto_Domain_Model_Tip $newTip = NULL) {
		$this->view->assign('newTip', $newTip);
	}


	/**
	 * Creates a new Tip and forwards to the list action.
	 *
	 * @param Tx_PbToto_Domain_Model_Tip $newTip a fresh Tip object which has not yet been added to the repository
	 * @return void
	 */
	public function createAction(Tx_PbToto_Domain_Model_Tip $newTip) {
		$this->tipRepository->add($newTip);
		$this->flashMessageContainer->add('Your new Tip was created.');
		
			
		$this->redirect('list');
	}


	
	/**
	 * Displays a form for editing an existing Tip
	 *
	 * @param Tx_PbToto_Domain_Model_Tip $tip the Tip to display
	 * @return string A form to edit a Tip 
	 */
	public function editAction(Tx_PbToto_Domain_Model_Tip $tip) {
		$this->view->assign('tip', $tip);
	}



	/**
	 * Updates an existing Tip and forwards to the list action afterwards.
	 *
	 * @param Tx_PbToto_Domain_Model_Tip $tip the Tip to display
	 */
	public function updateAction(Tx_PbToto_Domain_Model_Tip $tip) {
		$this->tipRepository->update($tip);
		$this->flashMessageContainer->add('Your Tip was updated.');
		$this->redirect('list');
	}


			/**
	 * Deletes an existing Tip
	 *
	 * @param Tx_PbToto_Domain_Model_Tip $tip the Tip to be deleted
	 * @return void
	 */
	public function deleteAction(Tx_PbToto_Domain_Model_Tip $tip) {
		$this->tipRepository->remove($tip);
		$this->flashMessageContainer->add('Your Tip was removed.');
		$this->redirect('list');
	}

public function x($output) {
	echo '<pre>'.print_r($output,1).'</pre>';
	die();
	
}
}
?>