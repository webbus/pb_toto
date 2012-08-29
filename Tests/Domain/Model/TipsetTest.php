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
 * Testcase for class Tx_PbToto_Domain_Model_Tipset.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Toto
 * 
 */
class Tx_PbToto_Domain_Model_TipsetTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_PbToto_Domain_Model_Tipset
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_PbToto_Domain_Model_Tipset();
	}

	public function tearDown() {
		unset($this->fixture);
	}
	
	
	/**
	 * @test
	 */
	public function getNameReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setNameForStringSetsName() { 
		$this->fixture->setName('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getName()
		);
	}
	
	/**
	 * @test
	 */
	public function getFeUserReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getFeUser()
		);
	}

	/**
	 * @test
	 */
	public function setFeUserForIntegerSetsFeUser() { 
		$this->fixture->setFeUser(12);

		$this->assertSame(
			12,
			$this->fixture->getFeUser()
		);
	}
	
	/**
	 * @test
	 */
	public function getResultsetReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getResultset()
		);
	}

	/**
	 * @test
	 */
	public function setResultsetForIntegerSetsResultset() { 
		$this->fixture->setResultset(12);

		$this->assertSame(
			12,
			$this->fixture->getResultset()
		);
	}
	
	/**
	 * @test
	 */
	public function getTipReturnsInitialValueForObjectStorageContainingTx_PbToto_Domain_Model_Tip() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getTip()
		);
	}

	/**
	 * @test
	 */
	public function setTipForObjectStorageContainingTx_PbToto_Domain_Model_TipSetsTip() { 
		$tip = new Tx_PbToto_Domain_Model_Tip();
		$objectStorageHoldingExactlyOneTip = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneTip->attach($tip);
		$this->fixture->setTip($objectStorageHoldingExactlyOneTip);

		$this->assertSame(
			$objectStorageHoldingExactlyOneTip,
			$this->fixture->getTip()
		);
	}
	
	/**
	 * @test
	 */
	public function addTipToObjectStorageHoldingTip() {
		$tip = new Tx_PbToto_Domain_Model_Tip();
		$objectStorageHoldingExactlyOneTip = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneTip->attach($tip);
		$this->fixture->addTip($tip);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneTip,
			$this->fixture->getTip()
		);
	}

	/**
	 * @test
	 */
	public function removeTipFromObjectStorageHoldingTip() {
		$tip = new Tx_PbToto_Domain_Model_Tip();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($tip);
		$localObjectStorage->detach($tip);
		$this->fixture->addTip($tip);
		$this->fixture->removeTip($tip);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getTip()
		);
	}
	
}
?>