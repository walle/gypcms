<?php
/**
 * @package gypcms
 */

namespace gypcms\page;

/**
 * The page used to display the 404 page
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Error404Page extends Page
{
  const TEMPLATENAME = '404.html';

  /**
   * Load the template and the data
   */
  public function __construct()
  {
    parent::__construct(Error404Page::TEMPLATENAME);
  }

  /**
   * 
   */
  public function loadData()
  {
    $this->post = new \gypcms\post\Error('404');
  }

  /**
   * The 404 page has no own settings
   */
  public function loadSettings()
  {
    $this->settings = array();
  }
}