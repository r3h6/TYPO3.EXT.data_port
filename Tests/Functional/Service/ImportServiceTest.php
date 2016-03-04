<?php
namespace Monogon\DataPort\Tests\Functional\Service;


use \Monogon\DataPort\Service\ImportService;
use \Monogon\DataPort\Service\Import\Configuration;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
/**
 *
 */
class ImportServiceTest extends \TYPO3\CMS\Core\Tests\FunctionalTestCase {



	protected $coreExtensionsToLoad = array('extbase');
	protected $testExtensionsToLoad = array('typo3conf/ext/data_port');


	/**
	 * ObjectManager
	 * @var TYPO3\CMS\Extbase\Object\ObjectManager
	 */
	protected $objectManager = NULL;

	/**
	 * @var \Monogon\DataPort\Service\ImportService
	 */
	protected $subject;


	public function setUp (){
		parent::setUp();
		$this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
		$this->subject = $this->objectManager->get(ImportService::class);

		$this->importDataSet(ORIGINAL_ROOT . 'typo3/sysext/core/Tests/Functional/Fixtures/pages.xml');


		// $this->setUpBasicFrontendEnvironment();
	}

	public function tearDown (){
		parent::tearDown();
		unset($this->subject);
		unset($this->objectManager);
	}

	/**
	 * @test
	 */
	public function import (){
		$data = 'EXT:data_port/Tests/Functional/Service/Fixtures/fe_users.xlsx';
		$configuration = new Configuration('fe_users', 0);
		$this->subject->import($data, $configuration);
	}



	/**
	 * [getLogger description]
	 * @return \TYPO3\CMS\Core\Log\Logger [description]
	 */
	protected function getLogger (){
		return \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Log\\LogManager')->getLogger(__CLASS__);
	}
}