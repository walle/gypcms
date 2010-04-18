<?php
date_default_timezone_set('Europe/Stockholm'); // TODO: Remove this
/**
 * @package gypcms
 */

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once dirname(__FILE__).'/../src/Autoloader.php';

$l = new gypcms\Autoloader();
$l->load();

$url = '/'.@$_REQUEST['url'];

$site = new gypcms\Site($url);

$site->dispatch();