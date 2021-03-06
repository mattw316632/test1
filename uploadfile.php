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
    $name = $obj["name"];
    $longitude = $obj["longitude"];
    $latitude = $obj["latitude"];
    $data = $obj["data"];
    $link = 'link';
    $bump = 0;
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "select * from image where name='$name' and user_id='$userId'";

    $getid = "select id from user where id='$userId'";

    $uploadImg = "INSERT INTO image(id, user_id ,name, longitude, latitude, bumps, data)  VALUES(NULL,'$userId', '$name', '$longitude','$latitude', '$bump', '$link')";

    $result = $conn->query($sql);
    if($obj["name"] != null){
        if($result->num_rows==0){
            
            $result = $conn->query($getid);    
            if($result->num_rows>0){

                $add = $conn->query($uploadImg);
                if($add == true){
                    
                    $outputObj->success = true;
                    $outputObj->message = "Image uploaded: '$name'";
                    
                    $result = $conn->query($sql);    
                    $idVal = $result->fetch_assoc();
                    $id = $idVal['id'];
                    
                    $upda = "UPDATE image SET data='$userId-$id.txt' WHERE user_id='$userId' and id='$id'";
                    
                    $upd = $conn->query($upda);
                    if(upd){
                        $outputObj->success = true;
                        $outputObj->message = "Image uploaded: '$name' Link: gs://mattw316632-201000.appspot.com/Photos/$userId-$id.txt";
                    }
                    
                    file_put_contents("gs://mattw316632-201000.appspot.com/Photos/$userId-$id.txt", $data);
                    
                    echo json_encode($outputObj);
                } else {
                    $outputObj->success = false;
                    $outputObj->message = "upload error"; 
                    echo json_encode($outputObj);
                }
            
            } else {
                $outputObj->success = false;
                $outputObj->message = "id error"; 
                echo json_encode($outputObj);
            }
            
        }
        else{
            $outputObj->success = false;
            $outputObj->message = "You have already used that name";
            echo json_encode($outputObj); 
        }
    }
    else{
        $outputObj->success = false;
        $outputObj->message = "Please enter a name";
        
        echo json_encode($outputObj); 
    }
 
    $conn->close();
    