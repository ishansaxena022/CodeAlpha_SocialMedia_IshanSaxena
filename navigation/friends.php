<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friends</title>
    <?php include "../css/links.php"; ?>
    <link rel="stylesheet" href="../css/headers.css">
</head>
<body>
    <?php //include 'dbcon.php';

        //if(isset($_SESSION['username'])){
          //  $allusers = "SELECT * from users";
            //$sql = mysqli_query($con,)
        //}
    ?>
    <?php
session_start(); // Start session for managing user login status

include '../dbcon.php'; // Include the database connection script

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect user to login page if not logged in
    exit();
}

$user_id = $_SESSION['user_id'];

// Query to retrieve user's friend list
$sql = "SELECT users.username
        FROM users
        INNER JOIN friendships ON (users.id = friendships.user2_id)
        WHERE friendships.user1_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch friend list
$friends = [];
while ($row = $result->fetch_assoc()) {
    $friends[] = $row['username'];
}

$stmt->close();
$con->close();
?>
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

    <h2>Friend List</h2>
    <ul>
        <?php foreach ($friends as $friend): ?>
            <li><?php echo $friend; ?></li>
        <?php endforeach; ?>
    </ul>
    <h2>Add New Friend</h2>
    <input type="text" id="friendUsername" placeholder="Enter friend's username">
    <button onclick="addFriend()">Add Friend</button>

    <script>
        function addFriend() {
            var friendUsername = document.getElementById("friendUsername").value;
            // AJAX request to add friend
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "add_friend.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Handle successful response
                        alert(xhr.responseText);
                    } else {
                        // Handle error response
                        alert("Error adding friend: " + xhr.responseText);
                    }
                }
            };
            xhr.send("friendUsername=" + friendUsername);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>