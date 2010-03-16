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
    $page = new \gypcms\page\Error404Page();

    foreach ($this->routes as $route)
    {
      if ($route->getUrl() == $request->getUrl())
      {
        if (class_exists($route->getPageClassName()))
        {
          $class = $route->getPageClassName();
          return new $class($request, $route);
        }
      }
    }

    //TODO: Make this much nicer
    
    $baseurl = \gypcms\Site::getInstance()->getBasedir();

    $file = $baseurl.'data/'.$request->getUrl();

    $file = str_replace('.html', '.yml', $file);

    if (file_exists($file))
    {
      if (is_dir($file))
      {
        $page = new \gypcms\page\ListPage($request, $route, $file);
      }
      else if (is_file($file))
      {
        // TODO: Fix up this
        $data = \sfYaml::load($file);
        $data = array_pop($data);
        if (@$data['page'] == 'gallery')
        {
          $page = new \gypcms\page\GalleryPage($request, $route, $file);
        }
        else
        {
          $page = new \gypcms\page\ArticlePage($request, $route, $file);
        }
      }
    }

    return $page;
  }

  /**
   * Loads all the configured routes from the config
   * @throws \LogicException If not required elements is present
   */
  private function loadRoutes()
  {
    $routes = \sfYaml::load($this->routesFile);
    foreach ($routes as $id => $route)
    {
      if (strlen($route['url']) == 0)
      {
        throw new \LogicException('A route must have a url. Route: '.$id.'');
      }

      if (strlen($route['page']) == 0)
      {
        throw new \LogicException('A route must have a page. Route: '.$id.'');
      }

      //TODO: null is not valid?
      $sort = new Sort('', Sort::ASC);
      if(count(@$route['sort']) > 0)
      {
        $sort = new Sort(@$route['sort']['data'], @$route['sort']['type']);
      }

      $limit = new Limit(0, Limit::PAGE);
      if(count(@$route['limit']) > 0)
      {
        $limit = new Limit(@$route['limit']['num'], @$route['limit']['type']);
      }

      $this->routes[$id] = new Route($route['url'], $route['page'], $sort, $limit, @$route['data']);
    }
  }
}