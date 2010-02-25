<?php

/**
 * @package gypcms
 */

namespace gypcms\page;

/**
 * The page used to display search results
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class SearchPage extends Page
{
  const TEMPLATENAME = 'search.html';

  public function  __construct(\gypcms\requestHandler\Request $request, \gypcms\routing\Route $route)
  {
    parent::__construct(SearchPage::TEMPLATENAME);
  }

  public function loadData()
  {
    $data = array('hits' => array());
    $this->data = $data;
  }

  public function loadSettings()
  {

  }
}