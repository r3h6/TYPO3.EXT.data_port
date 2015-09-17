<?php

namespace Monogon\DataPort\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 R3 H6 <r3h6@outlook.com>
 *
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
 * Test case for class \Monogon\DataPort\Domain\Model\Configuration.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author R3 H6 <r3h6@outlook.com>
 */
class ConfigurationTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Monogon\DataPort\Domain\Model\Configuration
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Monogon\DataPort\Domain\Model\Configuration();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTitle()
		);
	}

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() {
		$this->subject->setTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'title',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getConfigurationReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getConfiguration()
		);
	}

	/**
	 * @test
	 */
	public function setConfigurationForStringSetsConfiguration() {
		$this->subject->setConfiguration('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'configuration',
			$this->subject
		);
	}
}
