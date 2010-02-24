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
class Error404Page extends page\Page
{
  const NAME = '404.html';

  /**
   * Load the template and the data
   */
  public function __construct()
  {
    parent::__construct(Error404Page::NAME);
  }

  /**
   * The 404 page has no data
   */
  public function loadData()
  {

  }

  /**
   * The 404 page has no settings
   */
  public function loadSettings()
  {

  }
}