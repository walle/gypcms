<?php

/**
 * @package gypcms
 */

namespace gypcms\filter;

/**
 * Implements the Filter interface with nothing
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class BasicFilter implements Filter
{

  /**
   * Does nothing with the text just outputs the original string
   *
   * @param string $text
   * @return string
   */
  public function process($text)
  {
    return $text;
  }
}