<?php
/**
 * @package gypcms
 */

namespace gypcms\routing;

/**
 * Represents a route
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Route
{
  /**
   *
   * @var string The url the rute represents
   */
  private $url;

  /**
   *
   * @var string The name of the page to use
   * @see \gypcms\page\Page
   */
  private $page;

  /**
   *
   * @var Sort The sort object
   */
  private $sort;

  /**
   *
   * @var Limit The limit object
   */
  private $limit;

  /**
   *
   * @var string The name of the dataobject to display without file ending
   */
  private $data;

  /**
   *
   * @param string $url
   * @param string $page
   * @param Sort $sort
   * @param Limit $limit
   * @param string $data
   */
  function __construct($url, $page, \gypcms\routing\Sort $sort, \gypcms\routing\Limit $limit, $data)
  {
    $this->url = $url;
    $this->page = $page;
    $this->sort = $sort;
    $this->limit = $limit;
    $this->data = $data;
  }

  /**
   *
   * @return string The url identifier of the route
   */
  public function getUrl()
  {
    return $this->url;
  }

  /**
   *
   * @return string The name of the page to use
   */
  public function getPage()
  {
    return $this->page;
  }

  /**
   *
   * @return string The name of the page class to use
   */
  public function getPageClassName()
  {
    return '\\gypcms\page\\'.ucfirst($this->page).'Page';
  }

  /**
   *
   * @return Sort The sort object
   */
  public function getSort()
  {
    return $this->sort;
  }

  /**
   *
   * @return Limit The limit object
   */
  public function getLimit()
  {
    return $this->limit;
  }

  /**
   *
   * @return string The datafile to use without file ending relative to the data dir
   */
  public function getData()
  {
    return $this->data;
  }
}