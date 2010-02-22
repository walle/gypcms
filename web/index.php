<?php

/**
 * @package gypcms
 */

error_reporting(E_ALL);
ini_set("display_errors", 1);

include_once dirname(__FILE__).'/../lib/yaml/lib/sfYaml.php';

$settingsArr = sfYaml::load(dirname(__FILE__).'/../config/settings.yml');

$first = sfYaml::load(dirname(__FILE__).'/../data/'.str_replace('.html', '.yml', $_REQUEST['url']).'');

include_once dirname(__FILE__).'/../lib/twig/lib/Twig/Autoloader.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem(dirname(__FILE__).'/../templates/'.$settingsArr['settings']['theme']);

$twig = new Twig_Environment($loader, array(
//  'cache' => dirname(__FILE__).'/../cache/twigCache/',
));

$template = $twig->loadTemplate('article.html');
$template->display(array_merge(array_pop($settingsArr), array_pop($first)));