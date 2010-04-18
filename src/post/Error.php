<?php
/**
 * @package gypcms
 */

namespace gypcms\post;

/**
 * Represents an article
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Error implements Post
{
  /**
   *
   * @var string The title of the page
   */
  protected $title;

  /**
   *
   * @param string $title The title to use
   */
  function __construct($title)
  {
    $this->title = $title;
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
      'title' => $this->title
    );

    return $arr;
  }

  /**
   *
   * @return string Returns the filter to use
   */
  public function getFilter()
  {
    return $this->filter;
  }

  /**
   * Filter the data
   */
  public function filter()
  {
    
  }
}