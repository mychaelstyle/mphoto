<?php
require_once dirname(__FILE__).'/Photo.php';

if($argc==0){
  echo "Require file path\n";
  exit;
}
$path = $argv[1];
$dirRoot = isset($argv[2]) && strlen($argv[2])>0 ? $argv[2] : (isset($_SERVER['MPHOTO_ROOT']) ? $_SERVER['MPHOTO_ROOT'] : null);
if(is_null($dirRoot) || strlen($dirRoot)==0){
  echo "set root dir arg[2] or ENV, MPHOTO_ROOT!\n";
  exit;
}

$exif = new \mychaelstyle\photo\Photo($path);
echo $exif->getRegulatedPath($dirRoot);

