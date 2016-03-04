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
use \TYPO3\CMS\Core\Utility\ArrayUtility;
use Monogon\DataPort\Service\Import\DatabaseImportService;
/**
 * Configuration
 */
class Configuration {

	protected $table;
	protected $index;

	protected $limit = 0;
	protected $offset = 0;

	protected $importServiceClass = DatabaseImportService::class;

	protected $columns = array();

	public function __construct ($table, $index){
		$this->table = $table;
		$this->index = $index;
	}


	public function getColumns (){
		if (empty($this->columns)){
			foreach ($GLOBALS['TCA'][$this->table]['columns'] as $name => $tca){
				if (isset($tca['tx_dataport'][$this->index])){
					$this->columns[$name] = $tca['tx_dataport'][$this->index];
				}
			}
		}
		return $this->columns;
	}

	/**
	 * Returns the limit
	 *
	 * @return int $limit
	 */
	public function getLimit(){
		return $this->limit;
	}

	/**
	 * Sets the limit
	 *
	 * @param int $limit
	 * @return object $this
	 */
	public function setLimit($limit){
		$this->limit = $limit;
		return $this;
	}

	/**
	 * Returns the offset
	 *
	 * @return int $offset
	 */
	public function getOffset(){
		return $this->offset;
	}

	/**
	 * Sets the offset
	 *
	 * @param int $offset
	 * @return object $this
	 */
	public function setOffset($offset){
		$this->offset = $offset;
		return $this;
	}

	/**
	 * Returns the importServiceClass
	 *
	 * @return string $importServiceClass
	 */
	public function getImportServiceClass(){
		return $this->importServiceClass;
	}

	/**
	 * Sets the importServiceClass
	 *
	 * @param string $importServiceClass
	 * @return object $this
	 */
	public function setImportServiceClass($importServiceClass){
		$this->importServiceClass = $importServiceClass;
		return $this;
	}
}
