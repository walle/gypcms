<?php

namespace gypcms\twig;

/**
 * Filter for Twig that contains functionality for file operations
 */
class File extends \Twig_Extension
{
  /**
   *
   * @return array Return all the filters to Twig
   */
  public function getFilters()
  {
    return array(
      'file_exists' => new \Twig_Filter_Method($this, 'fileExistsFilter'),
    );
  }

  /**
   * Returns true if the file exists
   *
   * @param string $filename
   * @return bool
   */
  public function fileExistsFilter($filename)
  {
    return file_exists($filename);
  }

  /**
   *
   * @return string The name of the extension
   */
  public function getName()
  {
    return 'file';
  }
}