<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require 'vendor/autoload.php';
$name = "";
if(!empty($_GET['name'])) {
    $name = $_GET['name'];
}
if(empty($name)) exit();
$bucket = (new MongoDB\Client)->test->selectGridFSBucket();
$stream = $bucket->openDownloadStreamByName($name, ['revision' => 0]);
$contents = stream_get_contents($stream);
echo $contents;
//print_r($contents);