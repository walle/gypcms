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
class Article implements Post
{
  /**
   *
   * @var int The linux timestamp for when to publish the article
   */
  protected $publish;

  /**
   * If this is blank in the yaml file we use the value from the settings
   *
   * @var string The name of the author
   */
  protected $author;

  /**
   *
   * @var string The title of the article
   */
  protected $title;

  /**
   *
   * @var string A short description of the article
   */
  protected $preamble;

  /**
   *
   * @var string The text of the article
   */
  protected $body;

  /**
   *
   * @var string The filter to use
   */
  protected $filter;
  
  /**
   * Loads all data to the object
   *
   * @param Loader $loader The loader
   */
  public function load(\gypcms\data\Loader $loader = null)
  {
    $this->author = $loader->find('author');
    $this->body = $loader->find('body');
    $this->preamble = $loader->find('preamble');
    $this->publish = $loader->find('publish');
    $this->title = $loader->find('title');
    
    $this->filter = 'basic';
    if ($loader->find('filter'))
    {
      $this->filter = $loader->find('filter');
    }
  }

  /**
   * Returns the data in the object as an array
   *
   * @return array An array with the data in the object
   */
  public function toArray()
  {
    $arr = array(
      'author' => $this->author,
      'body' => $this->body,
      'preamble' => $this->preamble,
      'publish' => $this->publish,
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
    $cls = '\\gypcms\filter\\'.ucfirst($this->filter).'Filter';
    $filter = new $cls();

    if(strlen($this->body) > 0)
    {
      $this->preamble = $filter->process($this->preamble);
      $this->body = $filter->process($this->body);
    }
  }
}