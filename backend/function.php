<?php 

require_once '../backend/dbConnect.php';

function error422($message){
    $data = [
        'status' => 422,
        'message' => $message,
    ];

    header("HTTP/1.0 422 Unprocessable Entity");
    echo json_encode($data);
    exit();
}
function getThreadList(){
    global $conn;

    $query   = "SELECT threadID, title, image FROM thread ORDER BY updated_at DESC LIMIT 3";
    $query2  = "SELECT 
                    p.postID, p.content,
                    u.name AS poster_name,
                    u.profile_picture AS poster_avatar,
                    t.title AS thread_title,
                    t.threadID AS thread_id
                FROM 
                    posts p
                JOIN 
                    users u ON p.poster = u.userID  -- Assuming the users table has userID as the primary key
                JOIN 
                    thread t ON p.threadID = t.threadID  -- Assuming the threads table has threadID as the primary key
                ORDER BY 
                    p.created_at DESC  -- Assuming posts table has a created_at column for post creation time
                LIMIT 2;";
    $query_run = mysqli_query($conn, $query);
    $query2_run = mysqli_query($conn, $query2);


    if($query_run && $query2_run) {
        if(mysqli_num_rows($query_run) > 0 && mysqli_num_rows($query2_run) > 0) {
            $threads = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
            $posts = mysqli_fetch_all($query2_run, MYSQLI_ASSOC);

            $data = [
                'status' => 200,
                'message' => 'Thread list fetched successfully',
                'threads' => $threads,
                'posts' => $posts
            ];

            header("HTTP/1.0 200 Fetched Successfully");
            return json_encode($data);
        } else {
            return $data = ['status' => 200, 'message' => 'No Data'];
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
        ];

        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
}

function getPostList($threadID){
    global $conn;

    $query = "
        SELECT 
            p.postID,
            p.content,
            p.reaction_count,
            p.created_at,
            u.name AS poster_name,
            u2.name AS last_reaction_user,
            u.profile_picture,
            u.year_code,
            qp.content AS quoted_content
        FROM 
            Posts p
        JOIN 
            Users u ON p.poster = u.userID  -- Assuming 'userID' is the primary key in Users table
        LEFT JOIN 
            Users u2 ON p.last_reaction_user = u2.userID  -- Use u2 to get last reaction user details
        LEFT JOIN 
            Posts qp ON p.quoted_postID = qp.postID
        WHERE 
            p.threadID = $threadID
        ORDER BY 
            p.created_at DESC; 
        ";

    $query2 = "
        SELECT 
            t.title AS title,
            t.created_at,
            u.name AS creator
        FROM 
            thread t
        JOIN 
            users u ON t.userID = u.userID
        WHERE 
            t.threadID = $threadID;  
        ";

    $query_run = mysqli_query($conn, $query);
    $query2_run = mysqli_query($conn, $query2);

    if($query_run && $query2_run) {
        if(mysqli_num_rows($query2_run) > 0) {
            $posts = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
            $thread_info = mysqli_fetch_all($query2_run, MYSQLI_ASSOC);

            $data = [
                'status' => 200,
                'message' => 'Post lists fetched successfully',
                'thread_title' => $thread_info[0]['title'],
                'thread_creator' => $thread_info[0]['creator'],
                'thread_created_at' => $thread_info[0]['created_at'],
                'posts' => $posts
            ];

            // echo $data;

            header("HTTP/1.0 200 Fetched Successfully");
            return json_encode($data);
        } else {
            return $data = ['status' => 200, 'message' => 'No Data'];
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
        ];

        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
}

function getThreadListByTitle($title){
    global $conn;

    $query = "
    SELECT 
        threadID,
        title,
        image
    FROM 
        thread
    WHERE 
        title LIKE '%$title%'
    ORDER BY 
        updated_at DESC; 
    ";

    $query_run = mysqli_query($conn, $query);

    if($query_run) {
        if(mysqli_num_rows($query_run) > 0) {
            $threadList = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

            $data = [
                'status' => 200,
                'message' => 'Thread lists fetched successfully',
                'threadList' => $threadList,
            ];

        } else {
            $data = ['status' => 200, 'message' => 'No Data', 'threadList' => null];
        }
        
        header("HTTP/1.0 200 Fetched Successfully");
        return json_encode($data);
        
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
        ];

        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
}

function storePost($postInput){
    global $conn;

    $quoted_postID = mysqli_real_escape_string($conn, $postInput['quoted_post']);
    $threadID = mysqli_real_escape_string($conn, $postInput['threadID']);
    $userID = mysqli_real_escape_string($conn, $postInput['userID']);
    $content = mysqli_real_escape_string($conn, $postInput['content']);

    if(empty(trim($threadID)) || empty(trim($userID)) || empty(trim($content))){
        return error422('Missing information!');
    } else {
        // Tạo câu lệnh SQL
        $sql = "INSERT INTO posts (quoted_postID, threadID, poster, content) VALUES (?, ?, ?, ?)";

        // Chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiis", $quoted_postID, $threadID, $userID, $content);

        // Thực thi câu lệnh
        if ($stmt->execute()) {
            $data = [
                'status' => 201,
                'message' => 'Post Created Successfully!',
            ];
            header("HTTP/1.0 201 Created");
            return json_encode($data);
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error',
                'error' => $stmt->error
            ];
    
            header("HTTP/1.0 500 Internal Server Error");
            return json_encode($data);
        }
    }
}


function storeThread($threadInput){
    global $conn;

    $title = mysqli_real_escape_string($conn, $threadInput['title']);
    $image = mysqli_real_escape_string($conn, $threadInput['image']);
    $userID = mysqli_real_escape_string($conn, $threadInput['userID']);

    if(empty(trim($title)) || empty(trim($userID)) || empty(trim($userID))){
        return error422('Missing information!');
    } else {

        $stmt = $conn->prepare("INSERT INTO thread (userID, title, image) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $userID, $title, $image); // "ssi" means string, string, integer

        if ($stmt->execute()) {

            $query = "
                    SELECT 
                        threadID
                    FROM 
                        thread
                    WHERE 
                        title = '$title'
                    ";

            $query_run = mysqli_query($conn, $query);
            if(mysqli_num_rows($query_run) > 0) {
                $threadID = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
                $data = [
                    'status' => 201,
                    'message' => 'Thread Created Successfully!',
                    'threadID' => $threadID
                ];
    
                header("HTTP/1.0 201 Created");
                return json_encode($data);
            }

        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error',
                'error' => $stmt->error
            ];
    
            header("HTTP/1.0 500 Internal Server Error");
            return json_encode($data);
        }
    }
}

function updatePost($postInput) {
    global $conn;

    $postID = mysqli_real_escape_string($conn, $postInput['postID']);
    $content = mysqli_real_escape_string($conn, $postInput['content']);

    if(empty(trim($postID))){
        return error422('Missing postID!');
    } else {

        $stmt = $conn->prepare("UPDATE posts SET content =  ? WHERE postID = ?");
        $stmt->bind_param("si", $content, $postID); // "ssi" means string, string, integer

        if ($stmt->execute()) {
            $data = [
                'status' => 201,
                'message' => 'Post Updated Successfully!',
            ];
            header("HTTP/1.0 201 Updated");
            return json_encode($data);
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error',
                'error' => $stmt->error
            ];
    
            header("HTTP/1.0 500 Internal Server Error");
            return json_encode($data);
        }
    }
}

function deletePost($postInput) {
    global $conn;

    $postID = mysqli_real_escape_string($conn, $postInput['postID']);

    if(empty(trim($postID))){
        return error422('Missing postID!');
    } else {

        $stmt = $conn->prepare("DELETE FROM posts WHERE postID = ?");
        $stmt->bind_param("i", $postID); // "ssi" means string, string, integer

        if ($stmt->execute()) {
            $data = [
                'status' => 201,
                'message' => 'Post Deleted Successfully!',
            ];
            header("HTTP/1.0 201 Deleted");
            return json_encode($data);
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error',
                'error' => $stmt->error
            ];
    
            header("HTTP/1.0 500 Internal Server Error");
            return json_encode($data);
        }
    }
}