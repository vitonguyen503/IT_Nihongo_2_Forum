<?php

// Bỏ qua các lỗi và cảnh báo
error_reporting(E_ALL); // Bật báo lỗi để phát hiện vấn đề

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include 'function.php';

$requestMethod = $_SERVER["REQUEST_METHOD"];

// Xử lý yêu cầu OPTIONS
if ($requestMethod == "OPTIONS") {
    http_response_code(200);
    exit();
}

// Xử lý yêu cầu PUT
if ($requestMethod == "PUT") {
    // Lấy dữ liệu đầu vào
    $inputData = json_decode(file_get_contents("php://input"), true);

    // Kiểm tra nếu không có dữ liệu đầu vào
    if (is_null($inputData) || empty($inputData)) {
        http_response_code(400);
        echo json_encode([
            'status' => 400,
            'message' => 'No input data provided',
        ]);
        exit(); // Dừng thực hiện sau khi gửi phản hồi
    }

    // Cập nhật bài viết và trả về phản hồi
    $updatePost = updatePost($inputData);

    // Kiểm tra nếu cập nhật thành công
    if ($updatePost) {
        http_response_code(200);
        echo json_encode([
            'status' => 200,
            'message' => 'Post updated successfully',
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            'status' => 500,
            'message' => 'Failed to update post',
        ]);
    }
} else {
    http_response_code(405);
    echo json_encode([
        'status' => 405,
        'message' => 'Method Not Allowed',
    ]);
}
