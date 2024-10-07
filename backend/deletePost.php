<?php

error_reporting(0);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include 'function.php';

$requestMethod = $_SERVER["REQUEST_METHOD"];

// Xử lý yêu cầu OPTIONS
if ($requestMethod == "OPTIONS") {
    http_response_code(200);
    exit();
}

if ($requestMethod == "DELETE") {
    $inputData = json_decode(file_get_contents("php://input"), true);

    // Nếu không có dữ liệu từ json thì kiểm tra $_POST
    if (is_null($inputData)) {
        $inputData = $_POST;
    }

    // Kiểm tra dữ liệu đầu vào
    if (empty($inputData) || empty($inputData['postID'])) { // Giả sử bạn cần 'postID'
        http_response_code(422);
        echo json_encode([
            'status' => 422,
            'message' => 'Missing postID in input data',
        ]);
        exit();
    }

    // Gọi hàm deletePost với dữ liệu đầu vào
    $deletePost = deletePost($inputData);        

    // Kiểm tra kết quả từ hàm deletePost
    if ($deletePost) {
        echo json_encode(['status' => 200, 'message' => 'Post deleted successfully']);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 500, 'message' => 'Failed to delete post']);
    }
} else {
    http_response_code(405);
    echo json_encode([
        'status' => 405,
        'message' => 'Method Not Allowed',
    ]);
}
