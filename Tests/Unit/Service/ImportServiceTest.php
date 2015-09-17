<?php

namespace Monogon\DataPort\Tests\Unit\Service;

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
 * Test case for class \Monogon\DataPort\Service\ImportService.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author R3 H6 <r3h6@outlook.com>
 */
class ImportServiceTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \Monogon\DataPort\Service\ImportService
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \Monogon\DataPort\Service\ImportService();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 * @dataProvider importProvider
	 */
	public function import ($file = NULL){
		$this->subject->import($file);
	}

	public function importProvider (){
		return array(
			array('EXT:data_port/Tests/Resources/Private/Data.xlsx'),
		);
	}
}
