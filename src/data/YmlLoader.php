<?php
/**
 * @package gypcms
 */

namespace gypcms\data;

/**
 * A yml file data loader / data source
 * Uses the symfony yaml component
 * @see sfYaml
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class YmlLoader implements Loader
{
  /**
   *
   * @var array The loaded data
   */
  private $data;

  /**
   *
   * @var string The path to the file that contains data
   */
  private $filename;

  /**
   *
   * @param string $filename The filename to load
   * @throws \InvalidArgumentException If the filename isn't a file
   */
  public function __construct($filename)
  {
    if (is_file($filename) == false)
    {
      throw new \InvalidArgumentException('The filename must be a file');
    }

    $this->filename = $filename;
    $this->data = null;
  }

  /**
   * The loading function loads data from the file to the class
   */
  public function Load()
  {
    $data = \sfYaml::load($this->filename);
    $this->data = array_pop($data);
  }

  /**
   *
   * @return array The raw data
   */
  public function getRawData()
  {
    if ($this->data == null)
    {
      throw new \LogicException('Trying to get data without loading first');
    }

    return $this->data;
  }

  /**
   * Returns the data if it exists, null otherwise
   *
   * @param string $name
   * @return mixed|null
   */
  public function find($name)
  {
    if ($this->data == null)
    {
      throw new \LogicException('Trying to get data without loading first');
    }

    if (array_key_exists($name, $this->data))
    {
      return $this->data[$name];
    }

    return null;
  }

  /**
   * Searches the dataarray recursivly and returns the first match
   *
   * @param string $name
   * @return mixed|null
   */
  public function findGlobally($name)
  {
    if ($this->data == null)
    {
      throw new \LogicException('Trying to get data without loading first');
    }
    
    return $this->findInArray($name, $this->data);
  }

  /**
   * Searches an array recursivly for a named index, returns the first match
   * Returns null if no match
   *
   * @param string $name
   * @param array $array
   * @return mixed|null
   */
  private function findInArray($name, $array)
  {
    foreach ($array as $key => $value)
    {
      if ($key == $name)
      {
        return $value;
      }

      if (is_array($value))
      {
        $this->findInArray($name, $value);
      }
    }

    return null;
  }
}
