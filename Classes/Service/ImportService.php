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
use Monogon\DataPort\Service\Import\ExcelDataProvider;
use Monogon\DataPort\Service\Import\DatabaseImportService;
use Monogon\DataPort\Service\Import\Configuration;
use Monogon\DataPort\Service\Import\Exception\Exception as ImportServiceException;

/**
 * ImportService
 */
class ImportService {

	/**
	 * ObjectManager
	 * @var TYPO3\CMS\Extbase\Object\ObjectManager
	 * @inject
	 */
	protected $objectManager = NULL;

	public function import ($data, Configuration $configuration){

		$offset = 0;

		$dataProvider = $this->objectManager->get(ExcelDataProvider::class, $data, $offset);
		$importService = $this->objectManager->get($configuration->getImportServiceClass(), $configuration);

		//$this->signalSlotDispatcher->connect(get_class($reader), 'readDataset', $writer, 'writeDataset');

		$dataProvider->initializeObject();

		$failures = 0;

		while ($dataProvider->hasNextDataset()){
			try {
				$dataset = $dataProvider->getNextDataset();
				$importService->importDataset($dataset);
			} catch (ImportServiceException $exception){
				$failures++;
			}
		}


	}
}