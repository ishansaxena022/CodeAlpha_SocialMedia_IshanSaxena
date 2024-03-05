<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Project</title>
    <link href="css/heroes.css" rel="stylesheet">
    <?php include 'css/links.php'; ?>
</head>
<body>
<!-----------PHP script for Sign - In------------>
<?php
      include 'dbcon.php';
      if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Check if the username exists in the database
        $sql_check_user = "SELECT * FROM users WHERE username = ?";
        $stmt_check_user = $con->prepare($sql_check_user);
        $stmt_check_user->bind_param("s", $username);
        $stmt_check_user->execute();
        $result_check_user = $stmt_check_user->get_result();

        // $_SESSION['username'] = $result_check_user['username'];
        // $_SESSION['bio'] = $result_check_user['bio'];

        if ($result_check_user->num_rows == 1) {
            // Verify password
            $user = $result_check_user->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Password is correct, log the user in
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['bio'] = $user['bio'];
                
                $_SESSION['profile_picture'] = $user['profile_picture'];
                // Redirect user to the dashboard or home page
                header("Location: home.php");
                exit();
            } else {
                // Password is incorrect
                ?><script>alert("Wrong password");</script><?php
            }
        } else {
            // Username not found
            ?><script>alert("User not found");</script><?php
        }

        $stmt_check_user->close();
    }

    // Close connection
    $con->close();
?>


<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">The Social Project</h1>
        <p class="col-lg-10 fs-4">The Social Media Project is the fourth task in CodeAlpha. Log into your account and immerse yourself in the experience. </p>
      </div>
      <div class="col-md-10 mx-auto col-lg-5">
        <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
   
          <!--Email-->
          <div class="form-floating mb-3">
            <input name="username" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Username</label>
          </div>
          <!--Password-->
          <div class="form-floating mb-3">
            <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
          </div>
         
          <div class="checkbox mb-3">
            <label>
              <input type="checkbox" value="remember-me"> Remember me
            </label>
          </div>
          <button name="submit" class="w-100 btn btn-lg btn-primary" type="submit">Sign In</button>
          <br><br>
          <p>Not a member yet? <a href="signup.php">Join Us</a></p>
          <hr class="my-4">
          <small class="text-body-secondary">By clicking Sign In, you agree to the terms of use.</small>
        </form>
      </div>
    </div>
  </div
</body>
</html>