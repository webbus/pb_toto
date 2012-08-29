<?php
class Tx_PbToto_Soap {

	protected $client;
	public $errors = array();
	protected $options = array(
		'encoding' => 'UTF-8',
	   'connection_timeout' => 5,
      'exceptions' => 1,
	);
	
	protected $defaultLeague = "bl1";
	protected $leagueShortcuts = array (
		''=>'',
		'bl1' =>'1.Bundesliga',
		'bl2' =>'2.Bundesliga',
		'PD' =>'Spanien', 
		'SA' => 'Italien',
		'PL' =>'England', 
		'asl' =>'Holland', 
		'dfb' =>'DFB Pokal'
	);
	
	protected $groupOrderID;
	protected $leagueShortcut;
	protected $leagueSeason;
	
	protected $location = 'http://www.OpenLigaDB.de/Webservices/Sportsdata.asmx?WSDL';
	protected $params;

	function Tx_PbToto_Soap() {
		try	{

			$this->client = new SoapClient($this->location, $this->options);
			$this->params = new stdClass();
		}
		catch (SoapFault $e){$this->errorHandlingSoapFault($e);}
		catch (Exception $e){$this->errorHandlingException($e);}
	}
	
	/*
	 * 
	 * @param int $matchID Nr. des Matches
	 * @return stdClass GetMatchdataByGroupLeagueSaison Alle Infos zu einem Spieltag
	 * nameTeam1
	 * nameTeam2
	 * iconUrlTeam1
	 * iconUrlTeam2
	 * matchIsFinished
	 * pointsTeam1
	 * pointsTeam2
	 * matchID
	 */
	
	public function getMatchByMatchID($matchID) {
		try {

			$this->params->MatchID = $matchID;
			$response = $this->client->GetMatchByMatchID($this->params);
			return $response->GetMatchByMatchIDResult;

		}
		catch (SoapFault $e){$this->errorHandlingSoapFault($e);}
		catch (Exception $e){$this->errorHandlingException($e);}
	}

	/*
	 * @param string $leagueShortcut Bsp. bl1
	 * @return int GetCurrentGroupOrderIDResult Nr.des Spieltages
	 */
	public function getCurrentGroupOrderID($leagueShortcut){
		try {

			$this->params->leagueShortcut = $leagueShortcut;
			$response = $this->client->GetCurrentGroupOrderID($this->params);
			return $response->GetCurrentGroupOrderIDResult;

		}
		catch (SoapFault $e){$this->errorHandlingSoapFault($e);}
		catch (Exception $e){$this->errorHandlingException($e);}
	}
	
	/*
	 * 
	 * @param int $groupOrderID Nr. des Spieltages
	 * @param string $leagueShortcut Kürzel des Liga Bsp.bl1
	 * @param string $leagueSaison Bsp. 2011
	 * @return array GetMatchdataByGroupLeagueSaison Alle Infos zu einem Spieltag
	 * stdClass:
	 * nameTeam1
	 * nameTeam2
	 * iconUrlTeam1
	 * iconUrlTeam2
	 * matchIsFinished
	 * pointsTeam1
	 * pointsTeam2
	 * matchID
	 */
	
	protected function getMatchdataByGroupLeagueSaison($groupOrderID,$leagueShortcut,$leagueSaison){
		try {

			$this->params->leagueSaison = $leagueSaison;
			$this->params->leagueShortcut = $leagueShortcut;
			$this->params->groupOrderID = $groupOrderID;
			$response = $this->client->GetMatchdataByGroupLeagueSaison($this->params);
			$tmp = $response->GetMatchdataByGroupLeagueSaisonResult;

			return $tmp->Matchdata;

		}
		catch (SoapFault $e){$this->errorHandlingSoapFault($e);}
		catch (Exception $e){$this->errorHandlingException($e);}
	}	
	
	public function getSelectionYears () {
		$year = (int) date('Y');
		$years = array();
		$years [$year] = $year;
		$years [($year+1)]= $year+1;
		return $years;
	}
	
	public function getSelectionLeagueShortcuts() {
		return $this->leagueShortcuts;
	}
	
	public function getSelectionGroupOrders() {
		if(!$this->leagueShortcut) return array();
		$orderID = $this->getCurrentGroupOrderID($this->leagueShortcut);
		$tmp = array();
		$tmp['']="";
		$tmp[($orderID-1)] =  "Letzter Spieltag";
		$tmp[$orderID] =  "Aktueller Spieltag";
		$tmp[($orderID+1)] =  "Naechster Spieltag";
		$tmp[($orderID+2)] =  "Ueber Naechster Spieltag";
		return $tmp;
	}
	
	public function getSelectionMatches() {
		if(!$this->groupOrderID || !$this->leagueShortcut ||!$this->leagueSaison) return array();
		$matches = $this->getMatchdataByGroupLeagueSaison(
			$this->groupOrderID, $this->leagueShortcut, $this->leagueSaison);
		$back = array();
		$back[]= "";
		
		foreach($matches as $match) {
			$back[$match->matchID] = 	$match->nameTeam1." : ".$match->nameTeam2;
		}
		return $back;
	}
	
	public function setLeagueShortcut($leagueShortcut) {
		$this->leagueShortcut = $leagueShortcut;
	}
	public function setGroupOrderID($groupOrderID) {
		$this->groupOrderID = $groupOrderID;
	}
	public function setLeagueSaison($leagueSaison) {
		$this->leagueSaison = $leagueSaison;
	}	
	
	protected function errorHandlingSoapFault (SoapFault $e) {
		$this->errors = array ('code' => $e->faultcode, 'message' => $e->faultstring);
	}
	protected function errorHandlingException (Exception $e) {
		$this->errors = array ('code' => $e->getCode(), 'message' => $e->getMessage());
	}


public function x($output) {
	echo '<pre>'.print_r($output,1).'</pre>';
}

}


?>