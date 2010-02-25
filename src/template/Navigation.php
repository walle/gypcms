<?php

/**
 * @package gypcms
 */

namespace gypcms\template;

/**
 * The Navigation class contains functionality to generate a navigation from the data
 * and to load a template with that data
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Navigation
{
  /**
   *
   * @var array The items to pass to the template
   */
  protected $items;

  public function __construct()
  {
    $this->items = array();
    $this->loadItems();
  }

  protected function loadItems()
  {
    //TODO: Load real current value

    $this->items = array('items' => array('home' => array('name' => 'Home', 'url' => '/', 'current' => 'true')));

    $dataDir = \gypcms\Site::getInstance()->getBasedir().'data/';
    $files = scandir($dataDir);
    foreach ($files as $file)
    {
      if (is_dir($dataDir.$file) && $file != '.' && $file != '..')
      {
        $this->items['items'][] = array('name' => $file, 'url' => $file, 'current' => false);
      }
    }
  }

  public function getItems()
  {
    return $this->items;
  }
}