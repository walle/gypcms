<?php
/**
 * @package gypcms
 */

namespace gypcms\page;

/**
 * A special case class that can be used for the front page etc.
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class IndexPage extends \gypcms\page\Page
{
  const TEMPLATENAME = 'index.html';

  public function __construct(\gypcms\requestHandler\Request $request, \gypcms\routing\Route $route)
  {
    parent::__construct(IndexPage::TEMPLATENAME);
  }

  public function loadData()
  {
    $baseurl = \gypcms\Site::getInstance()->getBasedir();

    $file = $baseurl.'data/index.yml';

    $loader = new \gypcms\data\YmlLoader($file);
    $loader->load();

    // TODO: Check for missing fields that have fallback in settings eg

    $this->post = new \gypcms\post\Article();
    $this->post->load($loader);
  }

  public function loadSettings()
  {
    $this->settings = array();
  }
}