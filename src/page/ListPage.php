<?php

/**
 * @package gypcms
 */

namespace gypcms\page;

/**
 * The page used to display lists of articles
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class ListPage extends Page
{
  const TEMPLATENAME = 'list.html';

  /**
   *
   * @var string The path to the datafile directory
   */
  private $dir;

  public function  __construct(\gypcms\requestHandler\Request $request, \gypcms\routing\Route $route, $dir)
  {
    $this->dir = $dir;
    parent::__construct(ListPage::TEMPLATENAME);
  }

  public function loadData()
  {
    $this->post = new \gypcms\post\ArticleList($this->dir);
    $this->post->load(null);
  }

  public function loadSettings()
  {
    $this->settings = array();
  }
}