<?php
/**
 * @package gypcms
 */

namespace gypcms;

// TODO: Alot of work to clean this up

// TODO: Rewrite so it parses the filessystem on demand instead of at the load?

/**
 * Class that contains functionality to autoload the classes needed for the framework
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Autoloader
{
  private $basedir;

  private $classes;

  public function load()
  {
    $this->loadYaml();
    $this->loadTwig();
    $this->loadTextile();
    $this->loadSrc();

    spl_autoload_register(array($this, 'loadClass'));
  }

  private function loadSrc()
  {
    $this->basedir = dirname(__FILE__);
    $this->loadDir($this->basedir);
  }

  private function loadDir($dir)
  {
    $files = scandir($dir);
    foreach ($files as $file)
    {
      if ($file == '.' || $file == '..')
      {
        continue;
      }
      
      $file = $dir.'/'.$file;

      if (is_dir($file))
      {
        $this->loadDir($file);
      }
      else if (is_file($file))
      {
        $this->loadFile($file);
      }
    }
  }

  private function loadFile($file)
  {
    if (preg_match('/.\/Autoloader\.php/', $file) == false && preg_match('/.\/.+\.php/', $file) == true)
    {
      $name = substr($file, strpos($file, '/gypcms'));
      $name = substr($name, 0, strrpos($name, '.php'));
      $name = str_replace('src/', '', $name);
      $name = str_replace('/', '\\', $name);
      $this->classes[$name] = $file;
      $this->classes[substr($name, 1)] = $file;
    }
  }

  public function loadClass($class)
  {
    require_once $this->classes[$class];
  }

  private function loadYaml()
  {
    require_once dirname(__FILE__).'/../lib/yaml/lib/sfYaml.php';
  }

  private function loadTwig()
  {
    require_once dirname(__FILE__).'/../lib/twig/lib/Twig/Autoloader.php';
    \Twig_Autoloader::register();
  }

  private function loadTextile()
  {
    require_once dirname(__FILE__).'/../lib/textile/Textile.php';
  }
}