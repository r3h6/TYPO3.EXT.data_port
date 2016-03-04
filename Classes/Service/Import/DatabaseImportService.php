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

use Monogon\DataPort\Service\Import\Dto\Dataset;

/**
 * DatabaseImportService
 */
class DatabaseImportService implements ImportServiceInterface {

	/**
	 * SignalSlotDispatcher
	 * @var TYPO3\CMS\Extbase\SignalSlot\Dispatcher
	 * @inject
	 */
	protected $signalSlotDispatcher = NULL;

	/**
	 * [$formattedValueConverter description]
	 * @var Monogon\DataPort\Service\Import\Value\FormattedValueConverter
	 * @inject
	 */
	protected $formattedValueConverter = NULL;

	protected $configuration;

	public function __construct (Configuration $configuration){
		$this->configuration = $configuration;
	}

	public function importDataset (Dataset $dataset){


		$importData = array();
		foreach ($this->configuration->getColumns() as $columnName => $columnConfig){

			$value = $this->formattedValueConverter->convertFrom($columnConfig['value'], $dataset);

			$this->emitProcessValueSignal($value, $dataset);

			$importData[$columnName] = $value;
		}

		return $importData;
	}

	protected function doImport ($importData){

	}

	protected function emitProcessValueSignal (&$value, Dateset $dataset){
		$this->signalSlotDispatcher->dispatch(__CLASS__, 'processValue', array($value, $dataset));
	}

}
