<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

ini_set("max_execution_time", "6000");
function recursiveScan($dir, $bucket) {
    $tree = glob(rtrim($dir, '/') . '/*');
    if (is_array($tree)) {
        foreach($tree as $file) {
            if (is_dir($file)) {
                recursiveScan($file, $bucket);
            } elseif (is_file($file)) {
                $contentType = mime_content_type($file);
                //echo $contentType."<br>";
                if(!is_null($contentType) && (stripos($contentType, 'video') !== false || stripos($contentType, 'image') !== false)) {
                    echo $file."<br>";
                    $videos[] = $file;
                    $file_name = basename($file);
                    $file_put = fopen($file, 'rb');
                    $bucket->uploadFromStream($file_name, $file_put);
                    fclose($file_put);
                }
            }
        } 
    }
}


/*$videos = array();
$dir = 'D:\\';echo "<pre>";
$files = opendir($dir);print_r($files);
foreach($files as $file) {
   $filepath = $dir . '/' . $file;
   if(is_file($filepath)) {
       $contentType = mime_content_type($filepath);
       if(stripos($contentType, 'video') !== false) {
           $videos[] = $file;
       }
   }
}*/

$videos = [];
include_once("config.php");
$bucket = (new MongoDB\Client)->test->selectGridFSBucket();
recursiveScan("D:", $bucket);
print_r($videos);