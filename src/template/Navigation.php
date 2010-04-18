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
    $url = \gypcms\Site::getInstance()->getUrl();

    $matches = array();
    preg_match_all('/\/(.+)\//', $url, $matches);

    if (count($matches) > 1)
    {
      $currentFolder = array_pop($matches[1]);
    }
    else
    {
      $currentFolder = '';
    }

    $this->items = array('items' => array('home' => array('name' => 'Home', 'url' => '/', 'current' => (strlen($currentFolder) == 0))));

    $dataDir = \gypcms\Site::getInstance()->getBasedir().'data/';
    $files = scandir($dataDir);
    foreach ($files as $file)
    {
      if (is_dir($dataDir.$file) && $file != '.' && $file != '..')
      {
        $this->items['items'][] = array('name' => ucfirst($file), 'url' => '/'.$file.'/', 'current' => ($currentFolder == $file));
      }
    }
  }

  public function getItems()
  {
    return $this->items;
  }
}