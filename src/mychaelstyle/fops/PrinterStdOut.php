<?php
namespace mychaelstyle\fops;
require_once dirname(__FILE__).'/Printer.php';

class PrinterStd implements Printer {
  private $attrs = array();
  public function attr($key,$value=null) {
    if(is_null($value){
      return $this->attrs[$key];
    }
    $this->attrs[$key] = $value;
    return $value;
  }
  public function debug($message,$tag='default') {
    echo "[$tag] $message\n";
  }
  public function info($message,$tag='default') {
    echo "[$tag] $message\n";
  }
  public function error($message,$tag='default') {
    echo "[$tag] $message\n";
  }
}
