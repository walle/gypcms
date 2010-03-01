<?php

/**
 * @package gypcms
 */

namespace gypcms\filter;

/**
 * Interface for all filters
 * A filter is a way to modify the data before output
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
interface Filter
{
  /**
   *
   * @param string $text The text to process
   * @return string Returns the processed text
   */
  public function process($text);
}