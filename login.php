
<?php 

    $host = "mysql:dbname=db1;unix_socket=/cloudsql/mattw316632:europe-west1:test01";
    $database = "db1";
    $username = "user";
    $password ="";
    
    $conn = new mysqli(null, $username, '',
'db1', null, '/cloudsql/mattw316632-201000:europe-west1:test01');
    

    //$conn = new mysqli($host, $username, $passtword, $database);
    $json = file_get_contents('php://input');  
 
    $obj = json_decode($json,true);
    $uName= $obj->{'username'};
    $uPass = $obj->{'password'};
 
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "select * from user where username='$uName' and password='$uPass'";
    $result = $conn->query($sql);

    if($uName != null){
        if($result->num_rows==0){
            $outputObj->success = false;
            $outputObj->message = "User not found";
            
            echo json_encode($outputObj); 
        }
        else{
            $outputObj->success = true;
            $outputObj->user = $uName;
            
            echo json_encode($outputObj); 
        }
    }
    else{
        $outputObj->success = false;
        $outputObj->message = "Error";
        
        echo json_encode($outputObj); 
    }
 
    $conn->close();
    


