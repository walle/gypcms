<?php
/**
 * @package gypcms
 */

namespace gypcms;

/**
 * Class that contains functionality regarding to the config directory
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Config
{
  /**
   * Returns the filename of the configfile
   *
   * @param string $filename
   * @return string
   */
  public static function getConfigFile($filename)
  {
    return dirname(__FILE__).'/../config/'.$filename;
  }
}