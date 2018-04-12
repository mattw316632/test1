
<?php 

    $host = "mysql:dbname=db1;unix_socket=/cloudsql/mattw316632:europe-west1:test01";
    $database = "db1";
    $username = "user";
    $password ="";
    
    $conn = new mysqli(null, $username, '',
'db1', null, '/cloudsql/mattw316632:europe-west1:test01');
    

    //$conn = new mysqli($host, $username, $passtword, $database);
    $json = file_get_contents('php://input');  
 
    $obj = json_decode($json,true);
    $uName= $obj['username'];
    $uPass = $obj['password'];
 
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "select * from user where username='$uName' and password='$uPass'";
    $result = $conn->query($sql);

    if($obj['username']!=null){
        if($result->num_rows==0){
            $output = array('success' => false, 'message' => 'user not found');
            
            echo json_encode(output); 
        }
        else{
            $output = array('success' => true, 'user' => $uName);
            
            echo json_encode(output); 
        }
    }
    else{
        $output = array('success' => false, 'message' => 'error');
        
        echo json_encode(output); 
    }
 
    $conn->close();
    


