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
 * Repository for Tx_PbToto_Domain_Model_Resultset
 */
class Tx_PbToto_Domain_Repository_ResultsetRepository extends Tx_Extbase_Persistence_Repository {

	/**
	 * Returns all objects of this repository
	 *
	 * @return array An array of objects, empty if no objects found
	 * @api
	 */
	public function findAll() {
		$query = $this->createQuery();
		$query->setOrderings(array('begin' => Tx_Extbase_Persistence_QueryInterface::ORDER_ASCENDING));
		$result = $query->execute();
		return $result;
	}	
	
	  /**
	 * Returns all objects of this repository
	 *
	 * @return object The matching object if found, otherwise NULL
	 **/
	
	public function findCurrent() {
		$resultsets = $this->findAll();
		$distance = 0;
		$distance_save = 1000000;
		$currentResultset = '';
		foreach ($resultsets as $resultset) {
			$distance = (time() - $resultset->getBegin() >0) ? time() - $resultset->getBegin() : $resultset->getBegin() - time();
			if($distance < $distance_save) {
				$distance_save = $distance;
				$currentResultset = $resultset;
			}
		}
		
		/*
		if ($object !== NULL) {
				$this->identityMap->registerObject($object, $object->getUid());
		}
		*/
		return $currentResultset;
	
	}
	
	
	public function findPreviewFirst() {
		$resultsets = $this->findAll();
		$distance = 0;
		$distance_save = 1000000;
		$previewFirst = '';
		foreach ($resultsets as $resultset) {
			if($resultset->getEnd() > time()) {
				$distance = (time() - $resultset->getBegin() >0) ? time() - $resultset->getBegin() : $resultset->getBegin() - time();
				if($distance < $distance_save) {
					$distance_save = $distance;
					$previewFirst = $resultset;
				}
			}
		}
		return $previewFirst;
	}	

	public function findPreviewSecond() {
		$resultsets = $this->findAll();
		$resultsetFirst = $this->findPreviewFirst();
		$distance = 0;
		$distance_save = 1000000;
		$previewFirst = '';
		foreach ($resultsets as $resultset) {
			if($resultset->getEnd() > time() && $resultset->getUid() != $resultsetFirst->getUid()) {
				$distance = (time() - $resultset->getBegin() >0) ? time() - $resultset->getBegin() : $resultset->getBegin() - time();
				if($distance < $distance_save) {
					$distance_save = $distance;
					$previewFirst = $resultset;
				}
			}
		}
		return $previewFirst;
	}	
	
	
}
?>