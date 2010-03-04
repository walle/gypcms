<?php

/**
 * @package gypcms
 */

namespace gypcms\page;

/**
 * The page used to display a gallery
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class GalleryPage extends Page
{
  const TEMPLATENAME = 'gallery.html';

  /**
   *
   * @var string The file to load the data from
   */
  protected $file;

  public function  __construct(\gypcms\requestHandler\Request $request, \gypcms\routing\Route $route, $file)
  {
    $this->file = $file;

    parent::__construct(GalleryPage::TEMPLATENAME);
  }

  public function loadData()
  {
    $loader = new \gypcms\data\YmlLoader($this->file);
    $loader->load();

    // TODO: Check for missing fields that have fallback in settings eg

    $this->post = new \gypcms\post\Gallery();
    $this->post->load($loader);
  }

  public function loadSettings()
  {
    $this->settings = array();
  }
}