<?php

namespace gypcms\filter;

require_once 'PHPUnit/Framework.php';

require_once dirname(__FILE__).'/../../../src/filter/Filter.php';
require_once dirname(__FILE__).'/../../../src/filter/HtmlEntitiesFilter.php';

/**
 * Test class for HtmlEntitiesFilter.
 * Generated by PHPUnit on 2010-03-01 at 18:35:45.
 */
class HtmlEntitiesFilterTest extends \PHPUnit_Framework_TestCase
{
  /**
   * @var HtmlEntitiesFilter
   */
  protected $object;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp()
  {
    $this->object = new HtmlEntitiesFilter;
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown()
  {
  }

  /**
   * Tests the process method to make sure the output is using html entities
   */
  public function testProcess()
  {
    $this->assertEquals('Test &lt;b&gt;test&lt;/b&gt;', $this->object->process('Test <b>test</b>'));
    $this->assertEquals('Test &quot;&amp;&#039;&amp;&quot; test', $this->object->process('Test "&\'&" test'));
  }
}