<html>
<head>
    <title>Add Data</title>
</head>
 
<body>
<?php
//including the database connection file
include_once("config.php");
 
if(isset($_POST['Submit'])) {   
    if (isset($_FILES["cover"])) {
        $questionCover = $_FILES["cover"];
        $user["cover"] =  new MongoDB\BSON\Binary(file_get_contents($questionCover["tmp_name"]), MongoDB\BSON\Binary::TYPE_GENERIC);
    }
    $user["name"] = $_POST['name'];
    $user["age"]= $_POST['age'];
    $user["email"] = $_POST['email'];
        
    // checking empty fields
    $errorMessage = '';
    foreach ($user as $key => $value) {
        if (empty($value)) {
            $errorMessage .= $key . ' field is empty<br />';
        }
    }
    
    if ($errorMessage) {
        // print error message & link to the previous page
        echo '<span style="color:red">'.$errorMessage.'</span>';
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";    
    } else {
        //insert data to database table/collection named 'users'
        $db->insertOne($user);
        
        //display success message
        echo "<font color='green'>Data added successfully.";
        echo "<br/><a href='index.php'>View Result</a>";
    }
}
?>
</body>
</html>