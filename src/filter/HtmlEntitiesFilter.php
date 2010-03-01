<?php

/**
 * @package gypcms
 */

namespace gypcms\filter;

/**
 * A filter that converts all html into html entities
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class HtmlEntitiesFilter implements Filter
{

  /**
   * Runs the input through htmlentities with ENT_QUOTES
   *
   * @param string $text
   * @return string
   */
  public function process($text)
  {
    return htmlentities($text, ENT_QUOTES);
  }
}