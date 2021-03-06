<?php
/**
 * @package gypcms
 */

namespace gypcms\post;

/**
 * Defines the functions a post must implement
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
interface Post
{
  /**
   * Loads the data needed for the implementing class from the loader
   *
   * @param Loader $loader A object that implements the loader interface
   */
  public function load(\gypcms\data\Loader $loader = null);

  /**
   * Returns an array with all the mebers and data
   *
   * @return array An array of the object with key value pairs from the members
   */
  public function toArray();

  /**
   * Returns the filter to use, loaded from the post data
   *
   * @return string The filter to use, defaults to BasicFilter
   */
  public function getFilter();

  /**
   * Do the filtering of the post
   */
  public function filter();
}