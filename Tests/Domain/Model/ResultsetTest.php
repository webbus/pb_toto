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
*  the Free Software Foundation; either version 2 of the License, or
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
 * Testcase for class Tx_PbToto_Domain_Model_Resultset.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Toto
 * 
 */
class Tx_PbToto_Domain_Model_ResultsetTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_PbToto_Domain_Model_Resultset
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_PbToto_Domain_Model_Resultset();
	}

	public function tearDown() {
		unset($this->fixture);
	}
	
	
	/**
	 * @test
	 */
	public function getIsFinishedReturnsInitialValueForBoolean() { 
		$this->assertSame(
			TRUE,
			$this->fixture->getIsFinished()
		);
	}

	/**
	 * @test
	 */
	public function setIsFinishedForBooleanSetsIsFinished() { 
		$this->fixture->setIsFinished(TRUE);

		$this->assertSame(
			TRUE,
			$this->fixture->getIsFinished()
		);
	}
	
	/**
	 * @test
	 */
	public function getBeginReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getBegin()
		);
	}

	/**
	 * @test
	 */
	public function setBeginForIntegerSetsBegin() { 
		$this->fixture->setBegin(12);

		$this->assertSame(
			12,
			$this->fixture->getBegin()
		);
	}
	
	/**
	 * @test
	 */
	public function getEndReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getEnd()
		);
	}

	/**
	 * @test
	 */
	public function setEndForIntegerSetsEnd() { 
		$this->fixture->setEnd(12);

		$this->assertSame(
			12,
			$this->fixture->getEnd()
		);
	}
	
	/**
	 * @test
	 */
	public function getResultReturnsInitialValueForObjectStorageContainingTx_PbToto_Domain_Model_Result() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getResult()
		);
	}

	/**
	 * @test
	 */
	public function setResultForObjectStorageContainingTx_PbToto_Domain_Model_ResultSetsResult() { 
		$result = new Tx_PbToto_Domain_Model_Result();
		$objectStorageHoldingExactlyOneResult = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneResult->attach($result);
		$this->fixture->setResult($objectStorageHoldingExactlyOneResult);

		$this->assertSame(
			$objectStorageHoldingExactlyOneResult,
			$this->fixture->getResult()
		);
	}
	
	/**
	 * @test
	 */
	public function addResultToObjectStorageHoldingResult() {
		$result = new Tx_PbToto_Domain_Model_Result();
		$objectStorageHoldingExactlyOneResult = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneResult->attach($result);
		$this->fixture->addResult($result);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneResult,
			$this->fixture->getResult()
		);
	}

	/**
	 * @test
	 */
	public function removeResultFromObjectStorageHoldingResult() {
		$result = new Tx_PbToto_Domain_Model_Result();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($result);
		$localObjectStorage->detach($result);
		$this->fixture->addResult($result);
		$this->fixture->removeResult($result);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getResult()
		);
	}
	
}
?>