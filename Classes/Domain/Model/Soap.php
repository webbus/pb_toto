<?php

/**
 * Result
 */
class Tx_PbToto_Domain_Model_Soap extends Tx_Extbase_DomainObject_AbstractEntity {

	
	
	
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
	 * 
	 * Enter description here ...
	 * @param int $matchID
	 */
	
	protected  $matchID;
	
	/**
	 * @param int $matchID
	 */
	
	public function setMatchID($matchID) {
		$this->matchID = $matchID;
	}

	/**
	 * @return int $matchID
	 *
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
