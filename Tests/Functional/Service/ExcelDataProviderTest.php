<?php
namespace Monogon\DataPort\Tests\Functional\Service;


use \Monogon\DataPort\Service\Import\ExcelDataProvider;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use Monogon\DataPort\Service\Import\Dto\Dataset;
/**
 *
 */
class ExcelDataProviderTest extends \TYPO3\CMS\Core\Tests\FunctionalTestCase {



	protected $coreExtensionsToLoad = array('extbase');
	protected $testExtensionsToLoad = array('typo3conf/ext/data_port');


	/**
	 * ObjectManager
	 * @var TYPO3\CMS\Extbase\Object\ObjectManager
	 */
	protected $objectManager = NULL;

	/**
	 * @var \Monogon\DataPort\Service\ExcelDataProvider
	 */
	protected $subject;


	public function setUp (){
		parent::setUp();
		$this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
	}

	public function tearDown (){
		parent::tearDown();
		unset($this->objectManager);
	}

	/**
	 * @test
	 * @dataProvider importFileAndCheckNextDatasetDataProvider
	 */
	public function importFileAndCheckNextDataset ($offset, $key, $expected){
		$data = 'EXT:data_port/Tests/Functional/Service/Fixtures/fe_users.xlsx';

		/** @var Monogon\DataPort\Service\Import\ExcelDataProvider $subject */
		$subject = $this->objectManager->get(ExcelDataProvider::class, $data, $offset);

		$this->assertEquals(101, $subject->getTotalDatasetCount());
		$this->assertTrue($subject->hasNextDataset());

		$dataset = $subject->getNextDataset();

		$this->assertInstanceOf(Dataset::class, $dataset);
		$this->assertEquals($expected, $dataset->get($key));
	}

	public function importFileAndCheckNextDatasetDataProvider (){
		return array(
			array(0, 'Vorname', 'René'),
			array(1, 'Gruppe', 'Freund, Football'),
		);
	}

	/**
	 * [getLogger description]
	 * @return \TYPO3\CMS\Core\Log\Logger [description]
	 */
	protected function getLogger (){
		return \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Log\\LogManager')->getLogger(__CLASS__);
	}
}