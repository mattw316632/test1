
<?php 

    $host = "mysql:dbname=db1;unix_socket=/cloudsql/mattw316632:europe-west1:test01";
    $database = "test01";
    $username = "user";
    $password ="";
    
    $conn = new mysqli(null, $username, '',
'db1', null, '/cloudsql/mattw316632:europe-west1:test01');
    //$conn = new mysqli($host, $username, $passtword);
    $json = file_get_contents('php://input');  
 
    $obj = json_decode($json,true);
    $uName= $obj['username'];
    $uPass = $obj['password'];
 
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "select * from user where email='$uName' and password='$uPass'";
    $result = $conn->query($sql);

    if($obj['username']!=null){
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
    


