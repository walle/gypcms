<?php

/**
 * @package gypcms
 */

namespace gypcms\filter;

/**
 * A filter that uses the textile markup library to convert text to html in restricted mode
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class TextileRestrictedFilter implements Filter
{

  /**
   * Converts all text to html using textile
   *
   * @param string $text
   * @return string
   */
  public function process($text)
  {
    $textile = new \Textile();

    return $textile->TextileRestricted($text);
  }
}