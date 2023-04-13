<?php
@include 'config.php';

session_start();

if (isset($_POST['submit'])) {

  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = md5($_POST['password']);

  $select = "SELECT * FROM users WHERE email = '$email' && password = '$password' LIMIT 1";

  $result = mysqli_query($conn, $select);
  
   if ($result) {
    $user = mysqli_fetch_array($result);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
      $_SESSION['id'] = $user['id'];

      $_SESSION['session'] = $user;
      header('location:index.php');
    }
    else {
      $error[] = 'Incorrect email or password!';
    }
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
        <form action="" method="post">
          <div class="card">
            <div class="card-body">
            <div class="input-group mb-3">
              <input type="email" name="email"class="form-control" placeholder="Email">
            </div>
            <div class="input-group mb-3">
              <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
              <!-- /.col -->
              <div class="col-12">
                <button type="submit" name="submit" class="btn btn-primary btn-block" style="background-color: #26A89A;">Log-in</button>
                <a href="registration_page.php" class="btn btn-primary btn-block" style="background-color: #26A89A;">Register</a>
                <small class="d-block">currently logout</small>
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