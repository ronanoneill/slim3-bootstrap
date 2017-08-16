<?php
/**
 * Tests for the Dashboard Model
 *
 * @category  Test
 * @package   Slim3 Bootstrap
 * @author    Rónán O'Neill <youcanmailronan@gmail.com>
 * @license   Proprietary
 * @link      N/A
 */
class IndexTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test Dashboard data()
     *
     * @return void
     */
    public function testDashboard() {
        // Define the data
        $dashData = new \Model\Index();
        $testData = $dashData->pageRenderData();
        // Perform assertions
        $this->assertEquals(1, count($testData));
        $this->assertEquals('data_value', $testData['data_key']);
    }
}
