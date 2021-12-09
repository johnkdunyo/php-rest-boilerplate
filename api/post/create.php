<?php

//this is a post request



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

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;



//create post
if($post->create()){
    $mesg = "Post created succesfully";
    echo json_encode($mesg);
}else {
    $mesg =  'Post not created';
    echo json_encode($mesg);
}







?>