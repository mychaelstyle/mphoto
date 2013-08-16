<?php
require_once dirname(__FILE__).'/Photo.php';

if($argc==0){
  echo "Require file path\n";
  exit;
}
$path = $argv[1];
$exif = new \mychaelstyle\photo\Photo($path);
$exif->printAll();

