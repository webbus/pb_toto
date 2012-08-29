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
 * Resultset
 */
class Tx_PbToto_Domain_Model_Resultset extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * isFinished
	 *
	 * @var boolean
	 */
	protected $isFinished;

	/**
	 * begin
	 *
	 * @var integer
	 */
	protected $begin;

	/**
	 * end
	 *
	 * @var integer
	 */
	protected $end;

	/**
	 * result
	 *
	 * @lazy
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_PbToto_Domain_Model_Result>
	 */
	protected $result;


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
		$this->result = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * @param boolean $isFinished
	 * @return void
	 */
	public function setIsFinished($isFinished) {
		$this->isFinished = $isFinished;
	}

	/**
	 * @return boolean
	 */
	public function getIsFinished() {
		return $this->isFinished;
	}

	/**
	 * @return boolean
	 */
	public function isIsFinished() {
		return $this->getIsFinished();
	}

	/**
	 * @param integer $begin
	 * @return void
	 */
	public function setBegin($begin) {
		$this->begin = $begin;
	}

	/**
	 * @return integer
	 */
	public function getBegin() {
		return $this->begin;
	}

	/**
	 * @param integer $end
	 * @return void
	 */
	public function setEnd($end) {
		$this->end = $end;
	}

	/**
	 * @return integer
	 */
	public function getEnd() {
		return $this->end;
	}

	/**
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_PbToto_Domain_Model_Result> $result
	 * @return void
	 */
	public function setResult(Tx_Extbase_Persistence_ObjectStorage $result) {
		$this->result = $result;
	}

	/**
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_PbToto_Domain_Model_Result>
	 */
	public function getResult() {
		return $this->result;
	}

	/**
	 * @param Tx_PbToto_Domain_Model_Result the Result to be added
	 * @return void
	 */
	public function addResult(Tx_PbToto_Domain_Model_Result $result) {
		$this->result->attach($result);
	}

	/**
	 * @param Tx_PbToto_Domain_Model_Result the Result to be removed
	 * @return void
	 */
	public function removeResult(Tx_PbToto_Domain_Model_Result $resultToRemove) {
		$this->result->detach($resultToRemove);
	}

}
?>