
<?php 
/*
    $host = "localhost";
    $database = "test01";
    $username = "root";
    $password ="";

    $conn = new mysqli($host, $username, $passtword, $database);
    $json = file_get_contents('php://input');  
 
    $obj = json_decode($json,true);
    $email= $obj['email'];
    $password = $obj['password'];
 
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "select * from user where email='$email' and password='$password'";
    $result = $conn->query($sql);

    if($obj['email']!=null){
        if($result->num_rows==0){
            echo json_encode('Wrong Details');
        }
        else{
            echo json_encode('ok');
        }
    }
    else{
        echo json_encode('try_again');
    }
 
    $conn->close();
    */
echo 'Hello';
?>
