<?php
/**
 * @package gypcms
 */

namespace gypcms\post;

/**
 * Represents a list of articles
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class ArticleList implements Post
{
  /**
   *
   * @var array An array of ListArticle objects
   */
  protected $articles;

  /**
   *
   * @var string The title of the list
   */
  protected $title;
  
  /**
   *
   * @var string The dir to parse
   */
  private $dir;

  /**
   *
   * @param string $dir The directory where to find files
   */
  public function __construct($dir)
  {
    $this->dir = $dir;
  }

  /**
   * Loads the data into the object
   *
   * @param Loader $loader The loader is not used in this function. Use null
   */
  public function load(\gypcms\data\Loader $loader)
  {
    if ($loader != null)
    {
      throw new \LogicException('$loader is not null. This load function does not use the loader, something must be wrong.');
    }

    $files = scandir($this->dir);
    foreach ($files as $file)
    {
      if ($file != '.' && $file != '..')
      {
        $l = new \gypcms\data\YmlLoader($this->dir.'/'.$file);
        $l->Load();
        $a = new ListArticle($file);
        $a->load($l);
        $this->articles[] = $a;
      }
    }

    $this->title = basename($this->dir);
  }

  /**
   * Returns the data in the object as an array
   *
   * @return array The data array
   */
  public function toArray()
  {
    $a = array();
    foreach($this->articles as $article)
    {
      $a[] = $article->toArray();
    }
    
    $arr = array(
      'articles' => $a,
      'title' => $this->title
    );

    return $arr;
  }
}