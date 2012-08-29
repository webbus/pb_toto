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
class Tx_PbToto_Domain_Model_MultiTipsets extends Tx_Extbase_DomainObject_AbstractEntity {


	/**
	 * storage
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_PbToto_Domain_Model_Tipset>
	 */
	protected $storage;

	

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
		$this->storage = new Tx_Extbase_Persistence_ObjectStorage();
	}


	/**
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_PbToto_Domain_Model_Tipset> $storage
	 * @return void
	 */
	public function setStorage(Tx_Extbase_Persistence_ObjectStorage $storage) {
		$this->storage = $storage;
	}

	/**
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_PbToto_Domain_Model_Tipset>
	 */
	public function getStorage() {
		return $this->storage;
	}

	/**
	 * @param Tx_PbToto_Domain_Model_Tipset the Tipset to be added
	 * @return void
	 */
	public function addStorage(Tx_PbToto_Domain_Model_Tipset $tipset) {
		$this->storage->attach($tipset);
	}

	/**
	 * @param Tx_PbToto_Domain_Model_Tipset the Tip to be removed
	 * @return void
	 */
	public function removeStorage(Tx_PbToto_Domain_Model_Tipset $tipsetToRemove) {
		$this->storage->detach($tipsetToRemove);
	}

}
?>