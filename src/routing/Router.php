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
  /**
   * @var array An array with the configured routes
   */
  private $routes;

  /**
   *
   * @var string The name of the routes yml file
   */
  private $routesFile;

  public function __constructor()
  {
    $this->routesFile = Config::getConfigFile('routes.yml');
    $this->loadRoutes();
  }

  private function loadRoutes()
  {
    $this->routes = \sfYaml::load($this->routesFile);
  }
}