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
    
  }

  public function loadSettings()
  {

  }
}