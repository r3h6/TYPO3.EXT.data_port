<?php
namespace Monogon\DataPort\Tests\Selelenium;

class MyTest extends \PHPUnit_Extensions_Selenium2TestCase  {

// public static $browsers = array(
//       array(
//         'name'    => 'Firefox on Linux',
//         'browser' => '*firefox',
//         'host'    => '192.168.33.10',
//         'port'    => 4444,
//         'timeout' => 30000,
//       ),
//     );

	protected function setUp(){
		parent::setUp();
        $this->setBrowser('firefox');
        $this->setHost('192.168.33.10');
        $this->setBrowserUrl('http://typo3-6-2.lamp2/');
    }

	/**
	 * @test
	 */
	public function testTitle(){
		$this->url('http://typo3-6-2.lamp2/');
		$this->assertEquals('Home', $this->title());

		$link = $this->byXPath('/html/body/div/ul/li[1]/a');
		$link->click();

		$this->waitforpagetoload("30000");
		// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($link);
		// $this->waitForPageToLoad();
	}
}