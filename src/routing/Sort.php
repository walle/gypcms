<?php
/**
 * @package gypcms
 */

namespace gypcms\routing;

/**
 * Represents a sorting in a route
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Sort
{
  // Const definitions
  const ASC = 'asc';
  const DESC = 'desc';

  /**
   *
   * @var string On which data to sort
   */
  private $data;

  /**
   *
   * @var string the type of sort asc, desc
   */
  private $type;

  public function __construct($data, $type)
  {
    if ($type != Sort::ASC && $type != Sort::DESC)
    {
      //TODO: Enforce?
      //throw new \InvalidArgumentException('The type ('.$type.') is not defined');
    }

    $this->data = $data;
    $this->type = $type;
  }

  /**
   *
   * @return string The data column to sort on
   */
  public function getData()
  {
    return $this->data;
  }

  /**
   *
   * @return string The type of order
   */
  public function getType()
  {
    return $this->type;
  }
}