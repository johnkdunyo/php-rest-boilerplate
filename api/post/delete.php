<?php

//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Header: Access-Control-Allow-Header, Content-Type, Access-Control-Allow-Methods, Authorization, x-Requested-With');

include('../../configs/database.php');
include('../../models/post.php');



//instantiate db and connect
$database = new Database();
$db = $database->connect();


//instantia new post object
$post = new Post($db);



//get raw posted data

$data = json_decode(file_get_contents("php://input"));

//set id to update
$post->id = $data->id;


if($post->delete()){
    echo "Post deleted successfully";
}else{
    echo "Post can not be deleted.";
}





?>