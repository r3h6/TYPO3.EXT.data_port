<?php
namespace Monogon\DataPort\Service;


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

use \TYPO3\CMS\Core\Utility\GeneralUtility;
use PHPExcel_IOFactory;
use PHPExcel_Cell;
use PHPExcel_Cell_DataType;

/**
 * ImportService
 */
class ImportService {

	public function import ($file){
		$objPHPExcel = PHPExcel_IOFactory::load(GeneralUtility::getFileAbsFileName($file));
		foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
				$worksheetTitle     = $worksheet->getTitle();
				$highestRow         = $worksheet->getHighestRow(); // e.g. 10
				$highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
				$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
				$nrColumns = ord($highestColumn) - 64;
				echo "<br>The worksheet ".$worksheetTitle." has ";
				echo $nrColumns . ' columns (A-' . $highestColumn . ') ';
				echo ' and ' . $highestRow . ' row.';
				echo '<br>Data: <table border="1"><tr>';
				for ($row = 1; $row <= $highestRow; ++ $row) {
						echo '<tr>';
						for ($col = 0; $col < $highestColumnIndex; ++ $col) {
								$cell = $worksheet->getCellByColumnAndRow($col, $row);
								$val = $cell->getValue();
								$dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
								echo '<td>' . $val . '<br>(Typ ' . $dataType . ')</td>';
						}
						echo '</tr>';
				}
				echo '</table>';
		}
		exit;
	}
}