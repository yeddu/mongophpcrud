<?php
// including the database connection file
include_once("config.php");
if(isset($_POST['update']))
{
    $id = $_POST['id'];
    $user = array ('name' => $_POST['name'],'age' => $_POST['age'],'email' => $_POST['email']);
    // checking empty fields
    $errorMessage = '';
    foreach ($user as $key => $value) {
        if (empty($value)) {
            $errorMessage .= $key . ' field is empty<br />';
        }
    } 
    if (isset($_FILES["cover"]) && !empty($_FILES["cover"]["tmp_name"])) {
        $user["cover"] =  new MongoDB\BSON\Binary(file_get_contents($_FILES["cover"]["tmp_name"]), MongoDB\BSON\Binary::TYPE_GENERIC);
    }
    if ($errorMessage) {
        // print error message & link to the previous page
        echo '<span style="color:red">'.$errorMessage.'</span>';
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";    
    } else {//echo "<pre>";print_r($user);;die;
        //updating the 'users' table/collection
        $db->updateOne(array('_id' => new MongoDB\BSON\ObjectID($id)),array('$set' => $user));
        //redirectig to the display page. In our case, it is index.php
        header("Location: index.php");
    }
    exit();
}
?>
<?php
//getting id from url
$id = $_GET['id'];
//selecting data associated with this particular id
$result = $db->findOne(array('_id' => new MongoDB\BSON\ObjectID($id)));
$name = $result['name'];
$age = $result['age'];
$email = $result['email'];
?>
<html>
    <head>    
        <title>Edit Data</title>
    </head>
    <body>
        <a href="index.php">Home</a>
        <br/><br/>
        <form name="form1" method="post" action="edit.php" enctype="multipart/form-data">
            <table border="0">
                <tr> 
                    <td>Name</td>
                    <td><input type="text" name="name" value="<?php echo $name;?>"></td>
                </tr>
                <tr> 
                    <td>Age</td>
                    <td><input type="text" name="age" value="<?php echo $age;?>"></td>
                </tr>
                <tr> 
                    <td>Email</td>
                    <td><input type="text" name="email" value="<?php echo $email;?>"></td>
                </tr>
                <tr> 
                    <td>Profile Pic</td>
                    <td><input type="file" name="cover" ></td>
                </tr>
                <tr>
                    <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
                    <td><input type="submit" name="update" value="Update"></td>
                </tr>
            </table>
        </form>
    </body>
</html>