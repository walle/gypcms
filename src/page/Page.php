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
    $this->filter = null;
    $this->templateName = $templateName;

    $twig = \gypcms\Site::getInstance()->getTwigEnvironment();

    $this->template = $twig->loadTemplate($this->templateName);

    $this->data = array();
    $this->settings = array();

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
    $allData = array_merge($this->data, $this->settings, \gypcms\Site::getInstance()->getSettingsArray(), $nav->getItems());
    $this->template->display($allData);
  }

  /**
   * Filters the body with the selected filter
   */
  protected function filterData()
  {
    $filter = 'filter';
    $body = 'body';

    if (strlen(@$this->data[$filter]) == 0)
    {
      return;
    }

    $cls = '\\gypcms\filter\\'.ucfirst($this->data[$filter]).'Filter';
    $this->filter = new $cls();

    if(strlen(@$this->data[$body]) > 0)
    {
      $this->data[$body] = $this->filter->process($this->data[$body]);
    }
  }
}