<?php

/**
 * @package gypcms
 */

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once dirname(__FILE__).'/../src/Autoloader.php';

$l = new gypcms\Autoloader();
$l->load();

$settingsArr = sfYaml::load(dirname(__FILE__).'/../config/settings.yml');

$first = sfYaml::load(dirname(__FILE__).'/../data/'.str_replace('.html', '.yml', $_REQUEST['url']).'');

$loader = new Twig_Loader_Filesystem(dirname(__FILE__).'/../templates/'.$settingsArr['settings']['theme']);

$twig = new Twig_Environment($loader, array(
//  'cache' => dirname(__FILE__).'/../cache/twigCache/',
));

$template = $twig->loadTemplate('article.html');
$template->display(array_merge(array_pop($settingsArr), array_pop($first)));