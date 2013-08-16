<?php
namespace mychaelstyle\photo;

class Photo {
  private static $DATE_CANDIDATES = array(
    array('tag'=>'EXIF','name'=>'DateTimeOriginal'),
    array('tag'=>'EXIF','name'=>'DateTimeDigitized'),
    array('tag'=>'IFD0','name'=>'DateTime'),
    array('tag'=>'FILE','name'=>'FileDateTime'),
  );
  /**
   * @var string $path
   */
  private $path;
  /**
   * @var array $map
   */
  private $map = array();
  /**
   * constructor
   * @param string $path file path
   */
  public function __construct($path){
    if(strlen($path)==0){
      throw new \Exception('Require file path!');
    } else if(!file_exists($path)){
      throw new \Exception('The file not exists! '.$path);
    }
    $this->path = $path;
    if(false===exif_imagetype($path)){
      throw new \Exception('Not have exif headers');
    }
    $this->map = @exif_read_data($path,'EXIF,IFD0',true);
    if(isset($this->map['FILE'])
      && isset($this->map['FILE']['FileDateTime'])
      && !empty($this->map['FILE']['FileDateTime'])){
      $this->map['FILE']['FileDateTime'] = date('Y-m-d H:i:s',$this->map['FILE']['FileDateTime']);
    }
    if(isset($this->map['IFD0'])
      && isset($this->map['IFD0']['DateTime'])
      && !empty($this->map['IFD0']['DateTime'])){
      $this->map['IFD0']['DateTime'] =
      $this->convertDatetime($this->map['IFD0']['DateTime']);
    }
    if(isset($this->map['EXIF'])
      && isset($this->map['EXIF']['DateTimeOriginal'])
      && !empty($this->map['EXIF']['DateTimeOriginal'])){
      $this->map['EXIF']['DateTimeOriginal'] =
      $this->convertDatetime($this->map['EXIF']['DateTimeOriginal']);
    }
    if(isset($this->map['EXIF'])
      && isset($this->map['EXIF']['DateTimeDigitized'])
      && !empty($this->map['EXIF']['DateTimeDigitized'])){
      $this->map['EXIF']['DateTimeDigitized'] =
      $this->convertDatetime($this->map['EXIF']['DateTimeDigitized']);
    }
    return;
  }
  private function convertDatetime($datetime){
    if(strlen(trim($datetime))>0){
      list($date,$time) = explode(' ',$datetime);
      return str_replace(':','-',$date).' '.$time;
    }
    return null;
  }

  public function printAll($tag=null){
    $arr = $this->map;
    if(!is_null($tag)){
      $arr = $this->map[$tag];
    }
    foreach($arr as $tag => $values){
      if(is_array($values)){
        foreach($values as $key => $val){
          if(strpos($key,'Undefined')===0){
          } else {
            echo "  $tag.$key = $val\n";
          }
        }
      } else {
        echo "$tag = $values\n";
      }
    }
  }

  public function getValue($tag,$name){
    if(!isset($this->map[$tag]) && !is_array($this->map[$tag])){
      return null;
    } else if(!isset($this->map[$tag][$name])){
      return null;
    }
    return $this->map[$tag][$name];
  }

  public function getRegulatedPath($rootDir){
    $uri = $this->getRegulatedUri();
    if(!is_null($uri)){
      return $rootDir.'/'.$uri;
    }
    return null;
  }

  public function getRegulatedUri(){
    foreach(self::$DATE_CANDIDATES as $candidate){
      $date = $this->getValue($candidate['tag'],$candidate['name']);
      if(!is_null($date) && strlen($date)>0){
        $uri = $this->getDateUri($date);
        if(!is_null($uri)){
          return $uri;
        }
      }
    }
    return null;
  }

  private function getDateUri($date){
    $basename = basename($this->path);
    while(preg_match('/^[0-9]{2}_/',$basename)>0){
      $basename = preg_replace('/^[0-9]{2}_/','',$basename);
    }
    if(!is_null($date) && ($t = strtotime($date))){
      return date('Y/m/d_',$t).$basename;
    }
    return null;
  }
}
