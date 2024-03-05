<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <?php include 'css/links.php'; ?>
</head>
<body>
<?php
include 'dbcon.php'; // Include the database connection script

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $content = $_POST['content'];

    // Upload image file if provided
    $image_path = "";
    if ($_FILES['image']['name']) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        $image_path = $target_file;
    }

    // Prepare SQL query
    $sql = "INSERT INTO posts (user_id, content, image) VALUES (?, ?, ?)";
    $stmt = $con->prepare($sql);
    
    // Bind parameters
    $user_id = $_SESSION['user_id']; // Assuming user ID 1 for demonstration, you should replace it with actual user ID
    $stmt->bind_param("iss", $user_id, $content, $image_path);
    
    // Execute the query
    if ($stmt->execute()) {
        ?><script>alert("Post uploaded successfull!");
           location.replace("user/profile.php");
        </script>
         
        <?php
        //  header('location:/user/profile.php');
        //echo "Post created successfully!";
    } else {
        echo "Error: " . $con->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$con->close();
?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Upload Image
                    </div>
                    <div class="card-body">
                        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <!--Image  upload-->
                                <label for="image">Select image to upload:</label>
                                <input type="file" class="form-control-file" name="image" id="fileToUpload">
                                <!--Caption-->
                                <label for="exampleFormControlTextarea1" class="form-label">Caption:</label>
                                <textarea name="content" class="form-control" id="content" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Create Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
