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
class ListArticle extends Article
{
  /**
   *
   * @var string The url to the article from the list
   */
  protected $url;

  /**
   *
   * @param string $url Set the url for the article
   */
  function __construct($url)
  {
    $this->url = $url;
  }

   /**
   * Returns the data in the object as an array
   *
   * @return array An array with the data in the object
   */
  public function toArray()
  {
    $arr = parent::toArray();
    $arr['url'] = $this->url;

    return $arr;
  }
}