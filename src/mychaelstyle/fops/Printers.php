<?php
/**
 * printers
 * @package mychaelstyle
 * @subpackage fops
 */
namespace mychaelstyle\fops;

require_once dirname(__FILE__).'/Printer.php';

/**
 * printers
 * @package mychaelstyle
 * @subpackage fops
 */
class Printers {
  /**
   * @var array of Printer
   */
  private $printers = array();
  /**
   * constructor
   */
  public function __construct(){
    $this->printers = array();
  }
  /**
   * add
   */
  public function add(Printer $printer){
    $this->printers[] = $printer;
  }
  /**
   * remove
   */
  public function remove($printer){
    $renews = array();
    foreach($this->printers as $pr){
      if(is_string($printer){
        if($printer!=get_class($pr)){
          $renews[] = $pr;
        }
      } else if(is_object($printer) && is_a($printer,'Printer')){
        if(get_class($printer)!=get_class($pr)){
          $renews[] = $pr;
        }
      }
    }
    $tihs->printers = $renews;
  }
  /**
   * attr
   */
  public function attr($key,$value=null){
    foreach($this->printers as $pr){
      $pr->attr($key,$value);
    }
  }
  /**
   * debug
   * @param string $msg
   */
  public function debug($msg,$tag='default'){
    foreach($this->printers as $pr){
      $pr->debug($msg,$tag);
    }
  }
  /**
   * info
   * @param string $msg
   */
  public function info($msg,$tag='default'){
    foreach($this->printers as $pr){
      $pr->info($msg,$tag);
    }
  }
  /**
   * error
   * @param string $msg
   */
  public function error($msg,$tag='default'){
    foreach($this->printers as $pr){
      $pr->error($msg,$tag);
    }
  }
}
