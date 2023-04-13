<?php

@include('config.php');

if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);
    $confirm_password = md5($_POST['confirm_password']);
    $select = " SELECT * FROM users WHERE email = '$email' && password = '$password' ";
    $result = mysqli_query($conn, $select);
    

   if($password !== $confirm_password){
    $error[] = 'Password and Confirm password should match!';
   }elseif (mysqli_num_rows($result) > 0)
    {
      $error[] = 'user already exist!';

      }
      else {
        $insert = "INSERT INTO users (username, email, password) VALUES('$username', '$email','$password')";
            mysqli_query($conn, $insert);
            header('location:login_page.php');
      }
    };
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <title>Mini Blog Site</title>
</head>
<body style="background-color: #E6E6E6;">
  <?php
  @include('_header.php');

  ?>
  <?php
        if (isset($error)) {
          foreach ($error as $error) {
            echo '<span class="error-msg text-danger">' . $error . '</span>';
          };
        };
        ?>

<div class="container text-white col d-flex justify-content-center mt-5">
  
         <div style="min-width: 70%;">
         <div>  <h3 class="text-center text-black">Registration</h3>
</div>
        <form action="" method="post">
          <div class="card">
          <div class="card-header">
            <h4 class="text-black">See the Registration Rules</h4>
          </div>
            <div class="card-body">
            <div class="input-group mb-3">
          <input type="text" name="username"class="form-control" placeholder="Username">
        </div>
        <div class="input-group mb-3">
          <input type="email" name="email"class="form-control" placeholder="Email">
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
        </div>
        <div class="input-group mb-3">
          <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
        </div>
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" name="submit" class="btn btn-primary btn-block" style="background-color: #26A89A;">Register</button>
            <p>Return to <a href="login_page.php" class="text-center">Login Page</a></p>
            

          </div>
          <!-- /.col -->
        </div>
        </div>
        </div>
      </div>
      </form>
      </div>
</body>
</html>