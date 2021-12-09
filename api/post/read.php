<?php

//headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include('../../configs/database.php');
include('../../models/post.php');



//instantiate db and connect
$database = new Database();
$db = $database->connect();


//instantia new post object
$post = new Post($db);

$result = $post->read();

$num = $result->rowCount();

if($num > 0){
    //initialise an array
    $posts_arr = array();
    $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $post_item =  array(
            'id' => $id,
            'title' => $title,
            'body' => html_entity_decode($body),
            'author' => $author,
            'category_id' => $category_id,
            'category_name' => $category_name,
        );
        array_push($posts_arr['data'], $post_item);
    }


    //turn to json
    echo json_encode($posts_arr);



} else {
    $meg = array('message' => 'no post found');
    echo json_encode($meg);
    

}




?>