<?php

error_reporting(0);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include 'function.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204); // No Content
    exit();
}

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "POST") {
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
        $storeThread = storeThread($inputData);        
        echo $storeThread;
        return $storeThread;
    }
} else {
    http_response_code(405);
    echo json_encode([
        'status' => 405,
        'message' => 'Method Not Allowed',
    ]);
}
