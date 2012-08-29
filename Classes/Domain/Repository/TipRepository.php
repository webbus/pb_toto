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
 * Repository for Tx_PbToto_Domain_Model_Tip
 */
class Tx_PbToto_Domain_Repository_TipRepository extends Tx_Extbase_Persistence_Repository {

	public function findByUserAndResultset($user,$resultset) {


		$sql = "select * from tx_pbtoto_domain_model_tipset where hidden=0 and deleted=0"; 
		$sql.= " and fe_user=".$user;
		$sql.= " and resultset=".$resultset;
		
		$query = $this->createQuery();
		$query->statement($sql);

		die ($sql);
		$this->x($query->execute());
		return $query->execute();
	}	

	public function x($output) {
	echo '<pre>'.print_r($output,1).'</pre>';
}	
	
}
?>