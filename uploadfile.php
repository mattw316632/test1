<?php  
use google\appengine\api\cloud_storage\CloudStorageTools;  
$bucket = ‘ '; // your bucket name  
$root_path = 'gs://' . $bucket . '/';  
$_url = '';  
if(isset($_POST['submit']))  
{  
    if(isset($_FILES['userfile']))  
    {  
        $name = $_FILES['userfile']['name'];  
        $file_size =$_FILES['userfile']['size'];  
        $file_tmp =$_FILES['userfile']['tmp_name'];  
        $original = $root_path .$name;  
        move_uploaded_file($file_tmp, $original);  
        $_url=CloudStorageTools::getImageServingUrl($original);  
    }  
}  
  
?>  