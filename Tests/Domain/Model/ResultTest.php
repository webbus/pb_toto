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
 * Testcase for class Tx_PbToto_Domain_Model_Result.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Toto
 * 
 */
class Tx_PbToto_Domain_Model_ResultTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_PbToto_Domain_Model_Result
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_PbToto_Domain_Model_Result();
	}

	public function tearDown() {
		unset($this->fixture);
	}
	
	
	/**
	 * @test
	 */
	public function getNameTeam1ReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setNameTeam1ForStringSetsNameTeam1() { 
		$this->fixture->setNameTeam1('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getNameTeam1()
		);
	}
	
	/**
	 * @test
	 */
	public function getNameTeam2ReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setNameTeam2ForStringSetsNameTeam2() { 
		$this->fixture->setNameTeam2('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getNameTeam2()
		);
	}
	
	/**
	 * @test
	 */
	public function getIconUrlTeam1ReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setIconUrlTeam1ForStringSetsIconUrlTeam1() { 
		$this->fixture->setIconUrlTeam1('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getIconUrlTeam1()
		);
	}
	
	/**
	 * @test
	 */
	public function getIconUrlTeam2ReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setIconUrlTeam2ForStringSetsIconUrlTeam2() { 
		$this->fixture->setIconUrlTeam2('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getIconUrlTeam2()
		);
	}
	
	/**
	 * @test
	 */
	public function getMatchIsFinishedReturnsInitialValueForBoolean() { 
		$this->assertSame(
			TRUE,
			$this->fixture->getMatchIsFinished()
		);
	}

	/**
	 * @test
	 */
	public function setMatchIsFinishedForBooleanSetsMatchIsFinished() { 
		$this->fixture->setMatchIsFinished(TRUE);

		$this->assertSame(
			TRUE,
			$this->fixture->getMatchIsFinished()
		);
	}
	
	/**
	 * @test
	 */
	public function getPointsTeam1ReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getPointsTeam1()
		);
	}

	/**
	 * @test
	 */
	public function setPointsTeam1ForIntegerSetsPointsTeam1() { 
		$this->fixture->setPointsTeam1(12);

		$this->assertSame(
			12,
			$this->fixture->getPointsTeam1()
		);
	}
	
	/**
	 * @test
	 */
	public function getPointsTeam2ReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getPointsTeam2()
		);
	}

	/**
	 * @test
	 */
	public function setPointsTeam2ForIntegerSetsPointsTeam2() { 
		$this->fixture->setPointsTeam2(12);

		$this->assertSame(
			12,
			$this->fixture->getPointsTeam2()
		);
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
	public function getMatchIDReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getMatchID()
		);
	}

	/**
	 * @test
	 */
	public function setMatchIDForIntegerSetsMatchID() { 
		$this->fixture->setMatchID(12);

		$this->assertSame(
			12,
			$this->fixture->getMatchID()
		);
	}
	
}
?>