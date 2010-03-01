<?php
/**
 * @package gypcms
 */

namespace gypcms\page;

/**
 * The page used to display a article
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class ArticlePage extends Page
{
  const TEMPLATENAME = 'article.html';

  /**
   *
   * @var string The path to the datafile
   */
  private $file;

  public function  __construct(\gypcms\requestHandler\Request $request, \gypcms\routing\Route $route, $file)
  {
    $this->file = $file;
    parent::__construct(ArticlePage::TEMPLATENAME);
  }

  public function loadData()
  {
    $loader = new \gypcms\data\YmlLoader($this->file);
    $loader->load();

    // TODO: Check for missing fields that have fallback in settings eg

    $this->data = $loader->getRawData();
  }

  public function loadSettings()
  {

  }
}