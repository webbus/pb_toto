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
 * Repository for Tx_PbToto_Domain_Model_Tipset
 */
class Tx_PbToto_Domain_Repository_TipsetRepository extends Tx_Extbase_Persistence_Repository {

	public function findByUserAndResultset($user,$resultset) {

		$sql = "select * from tx_pbtoto_domain_model_tipset where hidden=0 and deleted=0"; 
		$sql.= " and fe_user=".$user;
		$sql.= " and resultset=".$resultset;
		
		$query = $this->createQuery();
		$query->statement($sql);

		return $query->execute();
	}

	/**
	 * 
	 * @param array  $users of array type of fe_users
	 * @param int $resultset
	 * return Tx_Extbase_Persistence_ObjectStorage<Tx_PbToto_Domain_Model_Tipset>
	 */
	
	public function findByUsersAndResultset($users,$resultset) {

		if(!users) return new Tx_Extbase_Persistence_ObjectStorage();
		
		$userString = "";
		foreach($users as $user) $userString.= "'".$user["uid"]."',";
		$userString = substr($userString,0,-1);
		
		$sql = "select * from tx_pbtoto_domain_model_tipset where hidden=0 and deleted=0"; 
		$sql.= " and fe_user in (".$userString.")";
		$sql.= " and resultset=".$resultset;
				
		$query = $this->createQuery();
		$query->statement($sql);

		return $query->execute();
	}	
	
}
?>