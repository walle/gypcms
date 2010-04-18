<?php

/**
 * @package gypcms
 */

namespace gypcms\filter;

/**
 * A filter that converts all http(s):// links in the text to a link
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class HttpLinksFilter implements Filter
{

  /**
   * Converts all links to html links
   *
   * @param string $text
   * @return string
   */
  public function process($text)
  {
    $pattern = '/(https?:\/\/[\w\.\-\+\/\~]+)/';
    
    $text = preg_replace($pattern, '<a href="$1">$1</a>', $text);
    
    return $text;
  }
}