<?php

/**
 * @package gypcms
 */

namespace gypcms;

/**
 * Class that contains functionality for generating classes from a wsdl file
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Site
{
  /**
  *
  * @var string The name of the site
  */
  protected $name;

  /**
   *
   * @var string The path to the logo file from the webroot
   */
  protected $logo;

  /**
   *
   * @var string The name of the author. Used as fallback if a post does not contain a explicit author
   */
  protected $author;

  /**
   *
   * @var string The language the site is in
   */
  protected $language;

  /**
   *
   * @var string The name of the theme used
   */
  protected $theme;

  /**
   * @var \gypcms\data\Loader The data loader for the settings
   */
  protected $loader;

  /**
   *
   * @var string The name of the settings yml file
   */
  private $settingsFile;

  /**
   *
   * @var string The current url requested
   */
  private $url;

  /**
   *
   * @var Site The dreaded singleton instance
   */
  private static $instance;

  public function __construct($url)
  {
    if (self::$instance != null)
    {
      throw new \LogicException('Site is trying to be constructet twice');
    }

    $this->url = $url;

    $this->settingsFile = Config::getConfigFile('settings.yml');
    $this->loadSettings();

    $this->name = $this->loader->find('name');
    $this->author = $this->loader->find('author');
    $this->theme = $this->loader->find('theme');
    $this->logo = $this->loader->find('logo');

    self::$instance = $this;
  }

  /**
   * Handle the request and show the appropriate page
   */
  public function dispatch()
  {
    $request = new \gypcms\requestHandler\Request();
    $router = new \gypcms\routing\Router();

    $page = $router->getPage($request);

    $page->render();
  }

  /**
   * Loads the templatedir and returns the environment
   *
   * @return \Twig_Environment
   */
  public function getTwigEnvironment()
  {
    $loader = new \Twig_Loader_Filesystem(dirname(__FILE__).'/../templates/'.$this->theme.'/');

    $environment = new \Twig_Environment($loader, array(
      'cache' => dirname(__FILE__).'/../cache/twigCache/',
    ));

    $environment->addExtension(new \gypcms\twig\File());

    return $environment;
  }

  /**
   *
   * @return array The settings array
   */
  public function getSettingsArray()
  {
    return $this->loader->getRawData();
  }

  /**
   * Searches for the setting by $settingName.
   * Returns null if it does not exist
   *
   * @param string $settingName
   * @return string|null
   */
  public function findSetting($settingName)
  {
    return $this->loader->find($settingName);
  }

  /**
   * TODO: Make this configurable?
   *
   * @return string Returns the basedir of the lib
   */
  public function getBasedir()
  {
    return dirname(__FILE__).'/../';
  }

  /**
   *
   * @return string The current request url
   */
  public function getUrl()
  {
    return $this->url;
  }

  /**
   * Loads the settings file
   *
   * @throws \LogicException If the settingsfile does not contain a settings block
   */
  private function loadSettings()
  {
    $this->loader = new data\YmlLoader($this->settingsFile);
   
    $this->loader->load();

    if ($this->loader->find('name') == null)
    {
      throw new \LogicException('The settings file does not contain a name element.');
    }

    if ($this->loader->find('language') == null)
    {
      throw new \LogicException('The settings file does not contain a language element.');
    }

    if ($this->loader->find('author') == null)
    {
      throw new \LogicException('The settings file does not contain a author element.');
    }

    if ($this->loader->find('theme') == null)
    {
      throw new \LogicException('The settings file does not contain a theme element.');
    }

    $this->loadCssFromSettings();

    $this->loadJavascriptsFromSettings();
  }

  private function loadCssFromSettings()
  {
    $css = '';

    $cssFiles = $this->loader->find('cssFiles');
    foreach ($cssFiles as $file)
    {
      if (strlen($file['url']) > 0)
      {
        $css .= '<link rel="stylesheet" type="text/css" href="'.$file['url'].'" media="'.($file['media'] ? $file['media'] : 'screen').'" />';
      }
    }

    $this->loader->add('css', $css);
  }

  private function loadJavascriptsFromSettings()
  {
    $js = '';

    $jsFiles = $this->loader->find('javascriptFiles');
    foreach ($jsFiles as $url)
    {
      if (strlen($url) > 0)
      {
        $js .= '<script type="text/javascript" src="'.$url.'"></script>';
      }
    }

    $js .= '<script type="text/javascript" src="/js/application.js"></script>';

    $this->loader->add('javascripts', $js);
  }

  /**
   *
   * @return Site The instance
   */
  public static function getInstance()
  {
    return self::$instance;
  }
}