<?php

require 'vendor/autoload.php';
/**
 * Connection to MongoDB
 * 
 * $connection = new MongoClient(); // connects to localhost:27017
 * 
 * For remote host connection
 * 
 * $connection = new MongoClient( "mongodb://example.com" ); // connect to a remote host (default port: 27017)
 * $connection = new MongoClient( "mongodb://example.com:65432" ); // connect to a remote host at a given port
 * 
 * Connection using database username and password
 * 
 * $connectionUrl = sprintf('mongodb://%s:%d/%s', $host, $port, $database);
 * $connection = new Mongo($connectionUrl, array('username' => $username, 'password' => $password));
 */ 
$connection = new MongoDB\Client("mongodb://localhost:27017");//new MongoDB\Driver\Manager("mongodb://localhost:27017");
 
/**
 * Select database named "test"
 */ 
 //if($connection) echo "Connected";var_dump($connection);
//$connection->startSession();
//$databaseName = "test";
//$collectionName = "users";
//
//$db = $connection->test;
////select a Collection
//   $collection = $db->selectCollection("users");
//
//
////$connection->selectDatabase($databaseName, array());
////$collection = $connection->selectCollection($databaseName, $collectionName);
//   $db = (new MongoDB\Client)->test;
//
//$users = $db->selectCollection(
//    'users',
//    [
//        'readPreference' => new MongoDB\Driver\ReadPreference(MongoDB\Driver\ReadPreference::RP_SECONDARY),
//    ]
//);
//$result = $users->find([]);
//echo "<pre>";var_dump($result);
$db = (new MongoDB\Client)->test->users;
//$db_files = (new MongoDB\Client)->test->fs.files;
//$bucket = (new MongoDB\Client)->test->selectGridFSBucket();

//foreach ($cursor as $restaurant) {
//   echo "<Pre>";print_r($restaurant);
//};
//$db->setReadPreference(MongoClient::RP_SECONDARY_PREFERRED);
//$collection = $db->users;//echo "<pre>";var_dump($collection);
//echo "<pre>";var_dump($collection);die;
?>