<?php

/**
 * @package gypcms
 */

namespace gypcms\page;

/**
 * Baseclass for all pages
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
abstract class Page
{
  /**
   *
   * @var string The name of the template the page uses
   */
  protected $templateName;

  /**
   *
   * @var \Twig_Template
   */
  protected $template;

  /**
   *
   * @var array An array with settings for the page
   */
  protected $settings;

  /**
   *
   * @var array An array containing the data for the template
   */
  protected $data;

  /**
   *
   * Loads the template from the environment
   * Loads all settings and data
   *
   * @param string $templateName
   */
  public function __construct($templateName)
  {
    $this->templateName = $templateName;

    $twig = \gypcms\Site::getInstance()->getTwigEnvironment();

    $this->template = $twig->loadTemplate($this->templateName);

    $this->data = array();
    $this->settings = array();

    $this->loadSettings();
    $this->loadData();
  }

  /**
   * Loads all the data for the page view
   */
  public abstract function loadData();

  /**
   * Loads all the settings for the page view
   */
  public abstract function loadSettings();

  /**
   * Render the page
   */
  public function render()
  {
    $allData = array_merge($this->data, $this->settings, \gypcms\Site::getInstance()->getSettings());
    $this->template->display($allData);
  }
}