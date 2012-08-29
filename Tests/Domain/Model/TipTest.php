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
 * Testcase for class Tx_PbToto_Domain_Model_Tip.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Toto
 * 
 */
class Tx_PbToto_Domain_Model_TipTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_PbToto_Domain_Model_Tip
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_PbToto_Domain_Model_Tip();
	}

	public function tearDown() {
		unset($this->fixture);
	}
	
	
	/**
	 * @test
	 */
	public function getTrendReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getTrend()
		);
	}

	/**
	 * @test
	 */
	public function setTrendForIntegerSetsTrend() { 
		$this->fixture->setTrend(12);

		$this->assertSame(
			12,
			$this->fixture->getTrend()
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
	public function getResultReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getResult()
		);
	}

	/**
	 * @test
	 */
	public function setResultForIntegerSetsResult() { 
		$this->fixture->setResult(12);

		$this->assertSame(
			12,
			$this->fixture->getResult()
		);
	}
	
}
?>