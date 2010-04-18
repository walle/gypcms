<?php

/**
 * @package gypcms
 */

namespace gypcms\filter;

/**
 * A filter that converts text to html
 * takes http:example.com and makes links.
 * Converts \n to <br />
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class TextFilter implements Filter
{

  /**
   * Converts all text to html
   *
   * @param string $text
   * @return string
   */
  public function process($text)
  {
    $httpLinksFilter = new \gypcms\filter\HttpLinksFilter();

    $text = nl2br($text, true);

    return $httpLinksFilter->process($text);
  }
}