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
   * @var \gypcms\filter\Filter
   */
  private $filter;

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
   * @var \gypcms\post\Post An object that implements the Post interface
   */
  protected $post;

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

    $this->loadSettings();
    $this->loadData();
    $this->filterData();
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
    // TODO: Make the allData into an object to ensure no owerwritten names in the template
    $nav = new \gypcms\template\Navigation();
    $allData = array_merge($this->post->toArray(), $this->settings, \gypcms\Site::getInstance()->getSettingsArray(), $nav->getItems());
    $this->template->display($allData);
  }

  /**
   * Filters the body with the selected filter
   */
  protected function filterData()
  {
    $this->post->filter();
  }
}