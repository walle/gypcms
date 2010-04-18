<?php
/**
 * @package gypcms
 */

namespace gypcms\data;

/**
 * A interface describing the methods needed for data loading
 * This is implemented by all specific data providers
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
interface Loader
{
  /**
   * The main method, this is where the loading happens
   * This should load the data and store it in a object or array in the class
   */
  public function load();

  /**
   * Get all the raw data as an array
   */
  public function getRawData();

  /**
   * Search the data for a named data and return it
   * Should return null if not found.
   *
   * @param string $name
   * @return mixed|null
   */
  public function find($name);

  /**
   * Adds data to the loaded data on demand
   *
   * @param string $key The key where to add
   * @param string $data The data to add
   */
  public function add($key, $data);
}
