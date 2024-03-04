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
<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3">The Social Project</h1>
        <p class="col-lg-10 fs-4">The Social Media Project is the fourth task in CodeAlpha. Log into your account and immerse yourself in the experience. </p>
      </div>
      <div class="col-md-10 mx-auto col-lg-5">
        <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary">
   
          <!--Email-->
          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email or username</label>
          </div>
          <!--Password-->
          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
          </div>
         
          <div class="checkbox mb-3">
            <label>
              <input type="checkbox" value="remember-me"> Remember me
            </label>
          </div>
          <button class="w-100 btn btn-lg btn-primary" type="submit">Sign In</button>
          <hr class="my-4">
          <small class="text-body-secondary">By clicking Sign In, you agree to the terms of use.</small>
        </form>
      </div>
    </div>
  </div
</body>
</html>