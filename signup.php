<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link href="css/heroes.css" rel="stylesheet">
    <?php include 'css/links.php'; ?>
</head>
<body>
<!--PHP script for Sign-Up Page -->
<?php
  include 'dbcon.php'; // Include the database connection script

  // Check if the form is submitted
  if (isset($_POST['submit'])) {
      // Get form data
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $bio = $_POST['bio'];
  
      // Check if username or email already exists
      $sql_check_user = "SELECT * FROM users WHERE username = ? OR email = ?";
      $stmt_check_user = $con->prepare($sql_check_user);
      $stmt_check_user->bind_param("ss", $username, $email);
      $stmt_check_user->execute();
      $result_check_user = $stmt_check_user->get_result();
  
      if ($result_check_user->num_rows > 0) {
          echo "Username or email already exists. Please choose another one.";
      } else {
          // Upload profile picture if provided

          $profile_picture = "";
          if (isset($_FILES['profile_picture']['name'])) {
              $target_dir = "profile_pictures/";
              $target_file = $target_dir . basename($_FILES['profile_picture']['name']);
              move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file);
              $profile_picture = $target_file;
          }
  
          // Insert new user into the database
          $sql_insert_user = "INSERT INTO users (username, email, password, profile_picture,bio) VALUES (?, ?, ?, ?,?)";
          $stmt_insert_user = $con->prepare($sql_insert_user);
          $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
          $stmt_insert_user->bind_param("sssss", $username, $email, $hashed_password, $profile_picture, $bio);
          
          if ($stmt_insert_user->execute()) {
              echo "Sign up successful";
              //Redirect user to login page or home page
              header("Location: index.php");
              exit();
          } else {
              echo "Error: " . $con->error;
          }
          $stmt_insert_user->close();
      }
  }
  
  // Close connection
  $con->close();
?>



<!--------Sign Up page--------->
<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-5 text-center text-lg-start">
        <h1 class="display-5 fw-bold lh-1 text-body-emphasis mb-3">Create Account</h1>
        <p class="col-lg-10 fs-4">CodeAlpha’s Task 4, The Social Media Project.Create an account and enter into an immersive experience. </p>
      </div>
      <div class="col-md-10 mx-auto col-lg-7">

        <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>"
         method="POST" enctype="multipart/form-data">
          <!--Username-->
          <div class="form-floating mb-3">
            <input name="username" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Username</label>
          </div>

          <!--Email-->
          <div class="form-floating mb-3">
            <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
          </div>
          <!--Password-->
          <div class="form-floating mb-3">
            <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
          </div>
        
          <!--Profile Picture-->
          <div class="form-group">
                <label for="profile_picture">Profile Picture:</label>
                <input name="profile_picture" type="file" class="form-control-file" id="profile_picture">
          </div>

          <!--Bio-->
          <div class="form-group">
              <label for="bio" class="form-label">Bio:</label>
              <textarea name="bio" class="form-control" id="bio" rows="3"></textarea>
          </div>
          
          <div class="checkbox mb-3">
            <label>
              <input type="checkbox" value="remember-me"> Remember me
            </label>
          </div>
          <button class="w-100 btn btn-lg btn-primary" name="submit" type="submit">Sign up</button><br><br>
          <div>
            <p>Already a member? <a href="../index.php">Login here</a></p>
          </div>
          <hr class="my-4">
          <small class="text-body-secondary">By clicking Sign up, you agree to the terms of use.</small>
        </form>
      </div>
    </div>
  </div>
</body>
</html>