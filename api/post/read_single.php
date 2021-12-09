<?php

//headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include('../../configs/database.php');
include('../../models/post.php');



//instantiate db and connect
$database = new Database();
$db = $database->connect();

//instantiae new post object
$post = new Post($db);


$post->id = isset($_GET['id']) ? $_GET['id'] : die();


$post->read_single();

$single_post_array = array( 
    'id' => $post->id,
    'title' => $post->title,
    'body' => $post->body,
    'author' => $post->author,
    'category_id' => $post->category_id,
    'category_name' => $post->category_name
);


//make json
print_r(json_encode($single_post_array));



?>