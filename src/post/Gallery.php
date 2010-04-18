<?php
/**
 * @package gypcms
 */

namespace gypcms\post;

/**
 * Represents an gallery
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Gallery implements Post
{
  /**
   *
   * @var int The linux timestamp for when to publish the gallery
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
   * @var string The title of the gallery
   */
  protected $title;

  /**
   *
   * @var string A short description of the gallery
   */
  protected $preamble;

  /**
   *
   * @var string The folder where to load the images
   */
  protected $folder;

  /**
   *
   * @var array Array of images
   */
  protected $images;

  /**
   *
   * @var string The filter to use
   */
  protected $filter;

  /**
   * Loads all data into the object
   *
   * @param Loader $loader The loader with the data
   */
  public function load(\gypcms\data\Loader $loader = null)
  {
    $this->author = $loader->find('author');
    $this->folder = $loader->find('folder');
    $this->preamble = $loader->find('preamble');
    $this->publish = $loader->find('publish');
    $this->title = $loader->find('title');

    $this->filter = 'BasicFilter';
    if ($loader->find('filter'))
    {
      $this->filter = $loader->find('filter');
    }

    $this->images = array();
    
    // TODO: Remove all hardcoded stuff here
    $dir = \gypcms\Site::getInstance()->getBasedir().'/web/uploads/images/'.$this->folder;

    $files = scandir($dir);
    foreach ($files as $file)
    {
      if ($file != '.' && $file != '..' && is_file($dir.'/'.$file))
      {
        // TODO: Remove all hardcoded stuff here
        $this->images[] = array(
          'url' =>'/uploads/images/'.$this->folder.'/'.$file,
          'title' => $file
        );
      }
    }
  }

  /**
   * Converts the object to an array
   *
   * @return array An array with the data
   */
  public function toArray()
  {
    $c = \gypcms\Site::getInstance()->findSetting('viewerclass');
    $viewerclass = ($c ? $c : 'fancybox');

    $arr = array(
      'author' => $this->author,
      'folder' => $this->folder,
      'preamble' => $this->preamble,
      'publish' => $this->publish,
      'title' => $this->title,
      'viewerclass' => $viewerclass
    );

    $arr['images'] = $this->images;

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

    if(strlen($this->preamble) > 0)
    {
      $this->preamble = $filter->process($this->preamble);
    }
  }
}
