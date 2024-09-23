<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers');

include 'function.php';

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "GET") {
    if (isset($_GET['threadID'])) {
        $threadId = $_GET['threadID'];
        $postList = getPostList($threadId);
        echo $postList;
    } else {
        $data = [
            'status' => 404,
            'message' => "Thread Not Found",
        ];
        header("HTTP/1.0 404 Not Found");
        echo json_encode($data);
    }
} else {
    $data = [
        'status' => 405,
        'message' => "$requestMethod Method Not Allowed",
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}