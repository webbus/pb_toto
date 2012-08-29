<?php 
/**
 * PBuss
 */

class Tx_PbToto_Utils {
	
	/**
	 * return @boolean
	 * 
	 */
	static function isTotoAdmin($adminGroupId) {
		
		$user = $GLOBALS["TSFE"]->fe_user->user;
		if (!$user) return false;
		
		$groups = explode(",",$user["usergroup"]);
		
		if(in_array($adminGroupId,$groups)) return true;
		else return false;
	}
	
	/**
	 * return array
	 */
	static function getFrontendUser($userId)  {
		$statement = "select * from fe_users where disable=0 and deleted=0 ";
		$statement .= "and uid=".$userId;
		$result = mysql_query($statement);
		$tmp = mysql_fetch_array($result);
		return $tmp;
	}
	
	
	/**
	 * return int id or false/0 in case of error
	 */
	static function getUserTotoGroupId($userId, $parentTotoGroupId) {
		if(!userId || !$parentTotoGroupId) return 0;		
		$userTotoGroupId = 0;
		
		$statement = "select usergroup from fe_users where disable=0 and deleted=0 ";
		$statement .= "and uid=".$userId;

		$result = mysql_query($statement);
		if($tmp = mysql_fetch_array($result)) {
			$groups = explode(',',$tmp["usergroup"]);

			if($groups) {
				$groupString = "";
				foreach ($groups as $group) $groupString .= "'".$group."',";
				$groupString = substr($groupString, 0, -1);

				$statement = "";
				$statement = "select * from fe_groups where deleted=0 and hidden=0 ";
				$statement .="and uid in (".$groupString.") ";
				$statement .="and subgroup=".$parentTotoGroupId;
				
				$tmp = "";
				$result = "";
				$result = mysql_query($statement);
				while($tmp = mysql_fetch_array($result)) {
					if($tmp["subgroup"] == $parentTotoGroupId) {
						$userTotoGroupId = $tmp["uid"];
					}
				}
			}
		}
		
		return $userTotoGroupId;		
	}
	
	/**
	 * return array of arrays type fe_users
	 */
	static function getUsersByTotoGroupId($totoGroupId){
		if(!$totoGroupId) return array();
		
		$users = array();
		
		$statement = "select * from fe_users where disable=0 and deleted=0 ";
		$statement .= "and (usergroup=".$totoGroupId ." ";
		$statement .= "or usergroup like '%,".$totoGroupId.",%' ";
		$statement .= "or usergroup like '".$totoGroupId.",%' ";
		$statement .= "or usergroup like '%,".$totoGroupId."') ";
		
		$result = mysql_query($statement);
		while($tmp = mysql_fetch_array($result)) {	
			$users[$tmp["uid"]] = $tmp;
		}	
		
		return $users;
	}
	
	static function sortUsers($a,$b) {
		return $a['points'] < $b['points'];
	}
	
}

?>
