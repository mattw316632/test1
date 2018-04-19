<?php 
    use Google\Cloud\Storage\StorageClient;

    $host = "mysql:dbname=db1;unix_socket=/cloudsql/mattw316632:europe-west1:test01";
    $database = "db1";
    $username = "user";
    $password ="";
    
    $conn = new mysqli(null, $username, '',
'db1', null, '/cloudsql/mattw316632-201000:europe-west1:test01');
    

    //$conn = new mysqli($host, $username, $passtword, $database);
    $json = file_get_contents('php://input');  
 
    $obj = json_decode($json,true);
    $userId= $obj["username"];
    $name = $obj["name"];
    $longitude = $obj["longitude"];
    $latitude = $obj["latitude"];
    $data = $obj["data"];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "select * from image where user_id='$userId'";
    $signup = "INSERT INTO image(id, user_id ,name, longitude, latitude, bump, data) VALUES(NULL,'$userID', '$name', '$longitude','$latitude', 0, '$data')";
    $result = $conn->query($sql);
    
    if($obj["name"] != null){
        if($result->num_rows>=0){
            $add = $conn->query($signup);
            if($add == true){
                $outputObj->success = true;
                $outputObj->image = $name;
                $outputObj->message = "image uploaded";
                
                file_put_contents("gs://mattw316632-201000.appspot.com/Photos/'$name'-'$id'.txt", $data);
            
                echo json_encode($outputObj);
            }
            
        }
        else{
            $outputObj->success = false;
            echo json_encode($outputObj); 
        }
    }
    else{
        $outputObj->success = false;
        $outputObj->message = "Please enter a name";
        
        echo json_encode($outputObj); 
    }
 
    $conn->close();
    