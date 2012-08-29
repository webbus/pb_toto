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
 * Tip
 */
class Tx_PbToto_Domain_Model_Tip extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * trend
	 *
	 * @var integer
	 * @validate NotEmpty
	 */
	protected $trend;

	/**
	 * feUser
	 *
	 * @var integer
	 * @validate NotEmpty
	 */
	protected $feUser;

	/**
	 * result
	 *
	 * @var Tx_PbToto_Domain_Model_Result
	 * @validate NotEmpty
	 */
	protected $result;

	/**
	 * @param integer $trend
	 * @return void
	 */
	public function setTrend($trend) {
		$this->trend = $trend;
	}

	/**
	 * @return integer
	 */
	public function getTrend() {
		return $this->trend;
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
	 * @param Tx_PbToto_Domain_Model_Result $result
	 * @return void
	 */
	public function setResult($result) {
		$this->result = $result;
	}

	/**
	 * @return Tx_PbToto_Domain_Model_Result
	 */
	public function getResult() {
		return $this->result;
	}

}
?>