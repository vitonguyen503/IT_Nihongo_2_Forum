<?php 

require_once '../backend/dbConnect.php';
function getThreadList(){
    global $conn;

    $query = "SELECT threadID, title, image FROM thread ORDER BY updated_at DESC LIMIT 3";
    $query2 = "SELECT 
                    p.postID, p.content,
                    u.name AS poster_name,
                    u.profile_picture AS poster_avatar,
                    t.title AS thread_title
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

    $query2 = "SELECT title FROM thread WHERE threadID = $threadID";

    $query_run = mysqli_query($conn, $query);
    $query2_run = mysqli_query($conn, $query2);

    if($query_run && $query2_run) {
        if(mysqli_num_rows($query2_run) > 0) {
            $posts = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
            $thread_title = mysqli_fetch_all($query2_run, MYSQLI_ASSOC);

            $data = [
                'status' => 200,
                'message' => 'Post lists fetched successfully',
                'thread_title' => $thread_title,
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