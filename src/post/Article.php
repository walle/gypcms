<?php
/**
 * @package gypcms
 */

namespace gypcms\post;

/**
 * Represents a post loaded from a yaml file
 *
 * @package gypcms
 * @author Fredrik Wallgren <fredrik@wallgren.me>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Article
{
  /**
   *
   * @var int The linux timestamp for when to publish the article
   */
  protected $publish;

  /**
   * If this is blank in the yaml file we use the value from the settings
   *
   * @var string The name of the author
   */
  protected $author;

  /**
   *
   * @var string The title of the article
   */
  protected $title;

  /**
   *
   * @var string A short description of the article
   */
  protected $preamble;

  /**
   *
   * @var string The text of the article
   */
  protected $body;

}