<?php

/**
 * @package gypcms
 */

namespace gypcms\routing;

/**
 * Manages routes
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Router
{
  const FILENAME = 'routing.yml';

  /**
   * @var array An array with the configured routes
   */
  private $routes;

  /**
   *
   * @var string The name of the routes yml file
   */
  private $routesFile;

  public function __construct()
  {
    $this->routesFile = \gypcms\Config::getConfigFile(Router::FILENAME);
    $this->loadRoutes();
  }

  public function getPage(\gypcms\requestHandler\Request $request)
  {
    return new \gypcms\page\Error404Page();
  }

  /**
   * Loads all the configured routes from the config
   */
  private function loadRoutes()
  {
    $this->routes = \sfYaml::load($this->routesFile);
  }
}