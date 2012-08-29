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
 * Result
 */
class Tx_PbToto_Domain_Model_Result extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * nameTeam1
	 *
	 * @var string
	 */
	protected $nameTeam1;

	/**
	 * nameTeam2
	 *
	 * @var string
	 */
	protected $nameTeam2;

	/**
	 * iconUrlTeam1
	 *
	 * @var string
	 */
	protected $iconUrlTeam1;

	/**
	 * iconUrlTeam2
	 *
	 * @var string
	 */
	protected $iconUrlTeam2;

	/**
	 * matchIsFinished
	 *
	 * @var boolean
	 */
	protected $matchIsFinished;

	/**
	 * pointsTeam1
	 *
	 * @var integer
	 */
	protected $pointsTeam1;

	/**
	 * pointsTeam2
	 *
	 * @var integer
	 */
	protected $pointsTeam2;

	/**
	 * trend
	 *
	 * @var integer
	 */
	protected $trend;

	/**
	 * matchID
	 *
	 * @var integer
	 * @validate NotEmpty
	 */
	protected $matchID;

	
	/**
	 * resultset
	 * 
	 * @var Tx_PbToto_Domain_Model_Resultset
	 * 
	 */

	protected $resultset;
	

	
	/**
	 * $groupOrderID
	 *
	 * @var string
	 */
	protected $groupOrderID;

	/**
	 * $leagueShortcut
	 *
	 * @var string
	 */
	protected $leagueShortcut;

	/**
	 * $leagueSeason
	 *
	 * @var string
	 */
	protected $leagueSeason;

	/**
	 * @return Tx_PbToto_Domain_Model_Resultset
	 *
	 */
	
	public function getResultset() {
		return $this->resultset;
	}
	
	/**
	 * @param Tx_PbToto_Domain_Model_Resultset $resultset
	 */
	
	public  function setResultset($resultset) {
		$this->resultset = $resultset;
	}

	
	/**
	 * @param string $nameTeam1
	 * @return void
	 */
	public function setNameTeam1($nameTeam1) {
		$this->nameTeam1 = $nameTeam1;
	}

	/**
	 * @return string
	 */
	public function getNameTeam1() {
		return $this->nameTeam1;
	}

	/**
	 * @param string $nameTeam2
	 * @return void
	 */
	public function setNameTeam2($nameTeam2) {
		$this->nameTeam2 = $nameTeam2;
	}

	/**
	 * @return string
	 */
	public function getNameTeam2() {
		return $this->nameTeam2;
	}

	/**
	 * @param string $iconUrlTeam1
	 * @return void
	 */
	public function setIconUrlTeam1($iconUrlTeam1) {
		$this->iconUrlTeam1 = $iconUrlTeam1;
	}

	/**
	 * @return string
	 */
	public function getIconUrlTeam1() {
		return $this->iconUrlTeam1;
	}

	/**
	 * @param string $iconUrlTeam2
	 * @return void
	 */
	public function setIconUrlTeam2($iconUrlTeam2) {
		$this->iconUrlTeam2 = $iconUrlTeam2;
	}

	/**
	 * @return string
	 */
	public function getIconUrlTeam2() {
		return $this->iconUrlTeam2;
	}

	/**
	 * @param boolean $matchIsFinished
	 * @return void
	 */
	public function setMatchIsFinished($matchIsFinished) {
		$this->matchIsFinished = $matchIsFinished;
	}

	/**
	 * @return boolean
	 */
	public function getMatchIsFinished() {
		return $this->matchIsFinished;
	}

	/**
	 * @return boolean
	 */
	public function isMatchIsFinished() {
		return $this->getMatchIsFinished();
	}

	/**
	 * @param integer $pointsTeam1
	 * @return void
	 */
	public function setPointsTeam1($pointsTeam1) {
		$this->pointsTeam1 = $pointsTeam1;
	}

	/**
	 * @return integer
	 */
	public function getPointsTeam1() {
		return $this->pointsTeam1;
	}

	/**
	 * @param integer $pointsTeam2
	 * @return void
	 */
	public function setPointsTeam2($pointsTeam2) {
		$this->pointsTeam2 = $pointsTeam2;
	}

	/**
	 * @return integer
	 */
	public function getPointsTeam2() {
		return $this->pointsTeam2;
	}

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
	 * @param integer $matchID
	 * @return void
	 */
	public function setMatchID($matchID) {
		$this->matchID = $matchID;
	}

	/**
	 * @return integer
	 */
	public function getMatchID() {
		return $this->matchID;
	}

	/**
	 * @param string $leagueShortcut
	 */
	
	public  function setLeagueShortcut($leagueShortcut) {
		$this->leagueShortcut = $leagueShortcut;
	}

	/**
	 * @return string $leagueShortcut
	 *
	 */
	
	public function getleagueShortcut() {
		return $this->leagueShortcut;
	}		
	
	/**
	 * @param string $groupOrderID
	 */
	
	public  function setGroupOrderID($groupOrderID) {
		$this->groupOrderID = $groupOrderID;
	}

	/**
	 * @return string $groupOrderID
	 *
	 */
	
	public function getGroupOrderID() {
		return $this->groupOrderID;
	}	
	
	/**
	 * @return string $leagueSeason
	 *
	 */
	
	public function getLeagueSeason() {
		return $this->leagueSeason;
	}
	

	
	/**
	 * @param string $groupOrderID
	 */
	
	public  function setLeagueSeason($leagueSeason) {
		$this->leagueSeason = $leagueSeason;
	}	
	
	
	
}
?>