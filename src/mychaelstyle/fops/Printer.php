<?php
/**
 * printer
 * @package mychaelstyle
 * @subpackage fops
 */
namespace mychaelstyle\fops;

/**
 * printer
 * @package mychaelstyle
 * @subpackage fops
 */
interface Printer {
  public function attr($key,$value=null);
  public function debug($message,$tag='default');
  public function info($message,$tag='default');
  public function error($message,$tag='default');
}

