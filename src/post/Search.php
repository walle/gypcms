<?php
/**
 * @package gypcms
 */

namespace gypcms\post;

/**
 * Represents an search
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Search implements Post
{
  /**
   *
   */
  function __construct()
  {

  }

  public function load(\gypcms\data\Loader $loader = null)
  {
    if ($loader != null)
    {
      throw new \LogicException('$loader is not null. This load function does not use the loader, something must be wrong.');
    }
  }

  public function toArray()
  {
    $arr = array(
    
    );

    return $arr;
  }

  /**
   *
   * @return string Returns the filter to use
   */
  public function getFilter()
  {
    return 'basic';
  }

  /**
   * Filter the data
   */
  public function filter()
  {

  }
}