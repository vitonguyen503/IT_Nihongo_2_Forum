<?php

error_reporting(0);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include 'function.php';

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "DELETE") {
    $inputData = json_decode(file_get_contents("php://input"), true);

    if (is_null($inputData)) {
        $inputData = $_POST;
    }

    if (empty($inputData)) {
        http_response_code(400);
        echo json_encode([
            'status' => 400,
            'message' => 'No input data provided',
        ]);
    } else {
        $deletePost = deletePost($inputData);        
        echo $deletePost;
    }
} else {
    http_response_code(405);
    echo json_encode([
        'status' => 405,
        'message' => 'Method Not Allowed',
    ]);
}
