<?php
namespace Monogon\DataPort\Service\Import;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 R3 H6 <r3h6@outlook.com>
 *
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

use PHPExcel_IOFactory;
use PHPExcel_Cell;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use Monogon\DataPort\Service\Import\Dto\Dataset;

/**
 * ExcelDataProvider
 */
class ExcelDataProvider implements DataProviderInterface {


	/**
	 * [$objPHPExcel description]
	 * @var PHPExcel
	 */
	protected $objPHPExcel = NULL;

	/**
	 * [$worksheet description]
	 * @var PHPExcel_Worksheet
	 */
	protected $worksheet = NULL;

	protected $rowPointer = 1;

	protected $totalRowCount = NULL;
	protected $highestColumnIndex = 0;

	protected $header = array();

	public function __construct ($data, $offset){
		$this->data = $data;
		$this->rowPointer += $offset;
	}

	public function initializeObject (){
		$this->objPHPExcel = PHPExcel_IOFactory::load(GeneralUtility::getFileAbsFileName($this->data));

		$this->worksheet = $this->objPHPExcel->getSheet(0);

		$highestColumn = $this->worksheet->getHighestColumn(); // e.g 'F'
		$this->highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

		$this->totalRowCount = $this->worksheet->getHighestRow();

		$this->header = array();
		for ($col = 0; $col < $this->highestColumnIndex; ++$col) {
			$cell = $this->worksheet->getCellByColumnAndRow($col, 1);
			$this->header[$col] = $cell->getValue();
		}
		$this->rowPointer++;

	}

	public function hasNextDataset (){
		return ($this->rowPointer < $this->totalRowCount);
	}

	public function getNextDataset (){
		$dataset = new Dataset();
		for ($col = 0; $col < $this->highestColumnIndex; ++$col) {
			$cell = $this->worksheet->getCellByColumnAndRow($col, $this->rowPointer);
			$dataset->add($this->header[$col], $cell->getValue());
		}
		$this->rowPointer++;
		return $dataset;
	}

	public function getTotalDatasetCount (){
		return $this->totalRowCount;
	}
}
