<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Friends</title>
    <?php include "../css/links.php"; ?>
    <link rel="stylesheet" href="../css/headers.css">
</head>
<body>
    <!--Navigation Bar-->
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                <svg class="bi" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
                <span class="fs-4">The Social Project</span>    
            </a>
            </div>

            <!--Navigation Menu-->
            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="../home.php" class="nav-link px-2 ">Home</a></li>
                <li><a href="../navigation/friends.php" class="nav-link px-2">Friends</a></li>
                <li><a href="../navigation/addfriend.php" class="nav-link px-2">Add Friends</a></li>
                
            </ul>

        <div class="col-md-3 text-end">
            
            <!-- <button type="button" class="btn btn-outline-primary me-2">Login</button>
            <button type="button" class="btn btn-primary">Log out</button> -->
            <!-- <img src="files/notifications.svg" alt="here" width="32" height="32"> -->
        </div>

        <div class="row">
            <!--Notification icon-->
            <div class="col">
                <a href="#"><img src="../files/notifications.svg" alt="Notifications" width="32" height="32"></a>
            </div>
            <!--Profile Button-->
            <div class="col dropdown text-end">
                <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                </a>
                <ul class="dropdown-menu text-small">
                    <li><a class="dropdown-item" href="../user/profile.php">My Profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="../logout.php">Sign out</a></li>
                </ul>
            </div>
        </div>
        </header>
    </div>

    <?php


include '../dbcon.php'; // Include the database connection script

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to add a friend.";
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get friend's username from the form
    $friendUsername = $_POST['friendUsername'];

    // Query to retrieve friend's user ID
    $sql = "SELECT id FROM users WHERE username = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $friendUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $friend_id = $row['id'];

        // Check if friendship already exists
        $sql_check_friendship = "SELECT * FROM friendships WHERE user1_id = ? AND user2_id = ?";
        $stmt_check_friendship = $con->prepare($sql_check_friendship);
        $stmt_check_friendship->bind_param("ii", $user_id, $friend_id);
        $stmt_check_friendship->execute();
        $result_check_friendship = $stmt_check_friendship->get_result();

        if ($result_check_friendship->num_rows == 0) {
            // Add new friendship
            $sql_add_friendship = "INSERT INTO friendships (user1_id, user2_id) VALUES (?, ?)";
            $stmt_add_friendship = $con->prepare($sql_add_friendship);
            $stmt_add_friendship->bind_param("ii", $user_id, $friend_id);
            if ($stmt_add_friendship->execute()) {
                echo "Friend added successfully!";
            } else {
                echo "Error adding friend: " . $con->error;
            }
            $stmt_add_friendship->close();
        } else {
            echo "You are already friends with " . $friendUsername . ".";
        }

        $stmt_check_friendship->close();
    } else {
        echo "User '" . $friendUsername . "' not found.";
    }

    $stmt->close();
}

$con->close();
?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>