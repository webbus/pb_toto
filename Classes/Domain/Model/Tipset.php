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
 * Tipset
 */
class Tx_PbToto_Domain_Model_Tipset extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * name
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $name;

	
	/**
	 * feUser
	 *
	 * @var integer
	 */
	protected $feUser;

	/**
	 * resultset
	 *
	 * @var Tx_PbToto_Domain_Model_Resultset
	 */
	protected $resultset;

	/**
	 * tip
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_PbToto_Domain_Model_Tip>
	 */
	protected $tip;

	

	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all Tx_Extbase_Persistence_ObjectStorage instances.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		/**
		* Do not modify this method!
		* It will be rewritten on each save in the kickstarter
		* You may modify the constructor of this class instead
		*/
		$this->tip = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param integer $feUser
	 * @return void
	 */
	public function setFeUser($feUser) {
		$this->feUser = $feUser;
	}

	/**
	 * @return integer
	 */
	public function getFeUser() {
		return $this->feUser;
	}

	/**
	 * @param Tx_PbToto_Domain_Model_Resultset $resultset
	 * @return void
	 */
	public function setResultset($resultset) {
		$this->resultset = $resultset;
	}

	/**
	 * @return Tx_PbToto_Domain_Model_Resultset
	 */
	public function getResultset() {
		return $this->resultset;
	}

	/**
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_PbToto_Domain_Model_Tip> $tip
	 * @return void
	 */
	public function setTip(Tx_Extbase_Persistence_ObjectStorage $tip) {
		$this->tip = $tip;
	}

	/**
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_PbToto_Domain_Model_Tip>
	 */
	public function getTip() {
		return $this->tip;
	}

	/**
	 * @param Tx_PbToto_Domain_Model_Tip the Tip to be added
	 * @return void
	 */
	public function addTip(Tx_PbToto_Domain_Model_Tip $tip) {
		$this->tip->attach($tip);
	}

	/**
	 * @param Tx_PbToto_Domain_Model_Tip the Tip to be removed
	 * @return void
	 */
	public function removeTip(Tx_PbToto_Domain_Model_Tip $tipToRemove) {
		$this->tip->detach($tipToRemove);
	}

}
?>