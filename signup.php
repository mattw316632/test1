
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
    $uName= $obj["username"];
    $uPass = $obj["password"];
 
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "select * from user where username='$uName'";
    $signup = "INSERT INTO user(id ,username, password) VALUES(1,'$uName', '$uPass')";
    $result = $conn->query($sql);
    
    if($obj["username"] != null){
        if($result->num_rows==0){
            $add = $conn->query($signup);
            if($add == true){
                $outputObj->success = true;
                $outputObj->user = $uName;
                $outputObj->message = "You have signed up";
            
                echo json_encode($outputObj);
            }
            
        }
        else{
            $outputObj->success = false;
            $outputObj->message = "Username taken";
            
            echo json_encode($outputObj); 
        }
    }
    else{
        $outputObj->success = false;
        $outputObj->message = "Please enter a username";
        
        echo json_encode($outputObj); 
    }
 
    $conn->close();
    


