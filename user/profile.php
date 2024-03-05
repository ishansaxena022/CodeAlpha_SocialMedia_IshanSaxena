<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <?php include "../css/links.php"; ?>
    <link rel="stylesheet" href="../css/headers.css">
    <link rel="stylesheet" href="../css/profile.css">

    <!--Custom CSS Code -->
    <style>
      /* Tooltip container */
      .tooltip {
        position: relative;
        display: inline-block;
        border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
      }

      /* Tooltip text */
      .tooltip .tooltiptext {
        visibility: hidden;
        width: 120px;
        background-color: black;
        color: #fff;
        text-align: center;
        padding: 5px 0;
        border-radius: 6px;
      
        /* Position the tooltip text - see examples below! */
        position: absolute;
        z-index: 1;
      }

      /* Show the tooltip text when you mouse over the tooltip container */
      .tooltip:hover .tooltiptext {
        visibility: visible;
      }
    </style>
</head>
<body>
    <!------Navigation Bar------->
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
            <!--Create Post-->
                <div class="col">
                <a href="../create_post.php"><img src="../files/upload.svg" alt="Upload" width="32" height="32" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Create Post"></a>
                </div>
                <!--Notification icon-->
                <div class="col">
                    <a href="#"><img src="../files/notifications.svg" alt="Notifications" width="32" height="32" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Notifications"></a>
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
    
    <!--User Profile Bio-->
   <div class="profile" >
   
        <div class="profile picture">
            <?php if(isset($_SESSION['profile_picture'])): ?>
                 <img src="../<?php echo $_SESSION['profile_picture']; ?>" >
            <?php endif; ?>
        </div>

        <h2><?php echo $_SESSION['username']; ?></h2>
        <p><?php echo $_SESSION['bio']; ?></p>
        <a href="#">Edit Profile</a>
        </div>
    </div>
      
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
          return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>