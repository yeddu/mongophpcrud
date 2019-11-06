<html>
<head>
    <title>Add Data</title>
</head>
 
<body>
<?php
//including the database connection file
include_once("config.php");
ini_set("max_execution_time", "6000");
ini_set("upload_max_filesize", "1000M");
ini_set("post_max_size", "1000M");
 
if(isset($_POST['Submit'])) {   
    if (isset($_FILES["cover"]) && !empty($_FILES["cover"]["tmp_name"])) {
        $bucket = (new MongoDB\Client)->test->selectGridFSBucket();
        $file = fopen($_FILES["cover"]["tmp_name"], 'rb');
        $bucket->uploadFromStream($_FILES["cover"]["name"], $file);
        echo "<br/><a href='files.php'>View Result</a>";
        exit();
    }
}
?>
</body>
</html>