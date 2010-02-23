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
   * @var array The raw array with settings values
   */
  protected $settings;

  /**
   *
   * @var string The name of the settings yml file
   */
  private $settingsFile;

  public function __construct()
  {
    $this->settingsFile = Config::getConfigFile('settings.yml');
    $this->loadSettings();

    $this->name = $this->settings['name'];
    $this->author = $this->settings['author'];
    $this->theme = $this->settings['theme'];
    $this->logo = $this->settings['logo'];
  }

  /**
   * Loads the settings file
   *
   * @throws \LogicException If the settingsfile does not contain a settings block
   */
  private function loadSettings()
  {
    $settings = \sfYaml::load($this->settingsFile);
    
    if (array_key_exists('settings', $settings) == false)
    {
      throw new \LogicException('The settings file does not contain a settings block.');
    }

    $this->settings = $settings['settings'];
  }
}