<?php
/**
 * Folder operation worker object class
 * @package mychaelstyle
 * @subpackage fops
 */
namespace mychaelstyle\fops;

/**
 * Folder operation object class
 * @package mychaelstyle
 * @subpackage fops
 */
interface Ops {
  /**
   * canDo
   * @param string $filePath
   */
  public function canDo($filePath);
  /**
   * ooops!!!!!
   * @param string $filePath
   */
  public function ooops($filePath,$printers);
}
