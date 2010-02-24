<?php
/**
 * @package gypcms
 */

namespace gypcms\routing;

/**
 * Represents a limit in a route
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Limit
{
  const PAGE = 'page';

  /**
   *
   * @var int The number of elements to limit to
   */
  private $num;

  /**
   *
   * @var string The type of limit ie. what to do when the limit is reached
   */
  private $type;

  function __construct($num, $type)
  {
    if ($type != Limit::PAGE)
    {
      //TODO: Enforce?
      //throw new \InvalidArgumentException('The type('.$type.') is unrecognised');
    }

    $this->num = $num;
    $this->type = $type;
  }

  /**
   *
   * @return int The limit of elements
   */
  public function getNum()
  {
    return $this->num;
  }

  /**
   *
   * @return string The type
   */
  public function getType()
  {
    return $this->type;
  }
}