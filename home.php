<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Feed</title>
    <?php include "css/links.php"; ?>
    <link rel="stylesheet" href="css/headers.css">
    <!--Custom CSS for POSTs section-->
    <style>
        .post {
            border: 2px solid #ccc;
            width: 720px;
            /* justify-content: center; */
            height: 720px;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5%;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            
        }
        .post img {
            max-width: calc(100% - 20px); /* Adjusted for padding */
            max-height: calc(100% - 20px); /* Adjusted for padding */
            width: auto;
            height: auto;
            padding: 10px;
        }
        .profpic{
            width: 5px;
            height:5    px;
            border-radius: 50%;

        }
    </style>
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
                <li><a href="home.php" class="nav-link px-2 ">Home</a></li>
                <li><a href="navigation/friends.php" class="nav-link px-2">Friends</a></li>
                <li><a href="navigation/addfriend.php" class="nav-link px-2">Add Friends</a></li>
            </ul>

        <div class="col-md-3 text-end">
            
            <!-- <button type="button" class="btn btn-outline-primary me-2">Login</button>
            <button type="button" class="btn btn-primary">Log out</button> -->
            <!-- <img src="files/notifications.svg" alt="here" width="32" height="32"> -->
        </div>

        <div class="row">
            <!--Notification icon-->
            <div class="col">
                <a href="#"><img src="files/notifications.svg" alt="Notifications" width="32" height="32"></a>
            </div>
            <!--Profile Button-->
            <div class="col dropdown text-end">
                <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                </a>
                <ul class="dropdown-menu text-small">
                    <li><a class="dropdown-item" href="user/profile.php">My Profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                </ul>
            </div>
        </div>
        </header>
    </div>
    

    <!--Home feed-->

    <div class="container mt-5">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <h2 class="mb-4">Home Feed</h2>
      <?php
      include 'dbcon.php'; // Include the database connection script

      // Query to fetch all posts
      $sql = "SELECT posts.*, users.username ,users.profile_picture
              FROM posts 
              INNER JOIN users ON posts.user_id = users.id 
              ORDER BY posts.created_at DESC";
      $result = $con->query($sql);

      // Check if there are posts
      if ($result->num_rows > 0) {
          // Output data of each row
          while ($row = $result->fetch_assoc()) {
            echo '<div class="card mb-4 rounded">';
            echo '<div class="card-header">';
            echo '<img src="' . $row['profile_picture'] . '" class="rounded-circle mr-2" width="50" height="50" alt="Profile Picture">';
            echo $row['username']; 
            echo '</div>';
            echo '<div class="card-body">';
            echo '<p class="card-text">' . $row['content'] . '</p>';
            echo '<img src="' . $row['image'] . '" class="img-fluid" alt="Posted Photo">';
            ?><br><br><div class="row">
                <div class="col-lg-1">
                    <a href=""><img src="files/like.svg" height="24" width="24" alt="Like"></a>
                </div>
                <div class="col-lg-1">
                <a href=""><img src="files/comment.svg" height="32" width="32" alt="Comment "></a>
                </div>
            <?php
            echo '</div>';
            echo '</div>';
      }
    }
      ?>

    </div>
  </div>
</div>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>