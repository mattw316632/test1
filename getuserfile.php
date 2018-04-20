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
    $userId= $obj["userid"];

     if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "select * from image where user_id='$userId'";
    
    $imageArr = [];

    $result = $conn->query($sql);
    if($result->num_rows==0){
        $imageObj->success = false;
        $imageObj->message = "No images found";
        array_push($imageArr, $imageObj);
        
        echo json_encode($imageArr);
        
    } else {
        
        $count = 0;
        while($val = $result->fetch_assoc()){
            $imageObj->success = true;
            $imageObj ->countVal = $count;
            $imageObj->id = $val['id'];
            $imageObj->userid = $val['user_id'];
            $imageObj->photoName = $val['name'];
            $imageObj->longitude = $val['longitude'];
            $imageObj->latitude = $val['latitude'];
            $imageObj->bumps = $val['bumps'];
            $imageObj->data = $val['data'];
            
            array_push($imageArr, $imageObj);
            $count++;
        }
        echo json_encode($imageArr); 
    }