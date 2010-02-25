<?php
/**
 * @package gypcms
 */

namespace gypcms\requestHandler;

/**
 * Class that represents a request
 * Contains functions to get post variables
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Request
{
  /**
   *
   * @var The "internal" url
   */
  protected $url;

  public function  __construct()
  {
    $url = @$_GET['url'];
    if (strlen($url) == 0)
    {
      $url = '/';
    }
    else if ($url[0] != '/')
    {
      $url = '/'.$url;
    }

    $this->url = $url;
  }

  /**
   *
   * @return string The url
   */
  public function getUrl()
  {
    return $this->url;
  }
}