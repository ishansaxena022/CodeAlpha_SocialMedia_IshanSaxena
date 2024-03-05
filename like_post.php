<?php
include 'dbcon.php'; // Include the database connection script

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get post ID and user ID from the form
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id']; // Assuming you have user authentication in place

    // Check if the user has already liked the post
    $sql_check_like = "SELECT * FROM likes WHERE post_id = ? AND user_id = ?";
    $stmt_check_like = $con->prepare($sql_check_like);
    $stmt_check_like->bind_param("ii", $post_id, $user_id);
    $stmt_check_like->execute();
    $result_check_like = $stmt_check_like->get_result();

    if ($result_check_like->num_rows == 0) { // User hasn't liked the post yet
        // Insert a new like
        $sql_insert_like = "INSERT INTO likes (post_id, user_id) VALUES (?, ?)";
        $stmt_insert_like = $con->prepare($sql_insert_like);
        $stmt_insert_like->bind_param("ii", $post_id, $user_id);
        if ($stmt_insert_like->execute()) {
            echo "Post liked successfully!";
        } else {
            echo "Error: " . $con->error;
        }
        $stmt_insert_like->close();
    } else {
        echo "You have already liked this post.";
    }
}

// Close connection
$con->close();
?>
