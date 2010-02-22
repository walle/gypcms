<?php

/**
 * @package gypcms
 */

namespace gypcms\page;

/**
 * Inteface for all pages
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
interface Page
{
  /**
   * All pages must have a render function to display itself
   */
  public function render();
}