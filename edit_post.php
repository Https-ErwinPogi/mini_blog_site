<?php
session_start();

if (!isset($_SESSION['session'])) {
  header('location:login_page.php');
}
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION);
  header("Location: login_page.php");
}
?>
<?php
//including the database connection file
include_once("config.php");

if(isset($_POST['update'])) {	
  $id = $_POST['id'];

    $title = $_POST['title'];
    $content = $_POST['content'];
    // checking empty fields
    if(empty($title) || empty($content)) {				
        if(empty($title)) {
          $error[] = "Title field is empty";
        }
		
        if(empty($content)) {
          $error[] = "Content field is empty";        }
		
        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else { 
        // if all the fields are filled (not empty) 
			
        //insert data to database	
        $result = mysqli_query($conn, "UPDATE posts SET title='$title', content='$content' WHERE id= $id");		
        header('location:index.php');
       
    }
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$stmtselect = "SELECT * FROM posts WHERE id=$id";
$res = mysqli_query($conn, $stmtselect);

while ($row = mysqli_fetch_assoc($res)) {
  $title  = $row['title'];
  $content  = $row['content'];
}
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
  <h1 class>Edit Post</h1>
  <div class="container mt-5">
        <form action="" method="post">
          <div class="card">
            <div class="card-body">
            <div>
              <small class="d-block">Enter new title</small>
              </div>
            <div class="input-group mb-3">
              
              <input type="text" name="title"class="form-control d-block" value="<?php echo $title; ?>" placeholder="Title">
            </div>
            <div>
            <small class="d-block">Enter new content</small>
            </div>
            <div class="input-group mb-3">
             
              <input type="text" name="content" class="form-control d-block" value="<?php echo $content; ?>" placeholder="Content">
            </div>
              <!-- /.col -->
              <div class="col-12">
              <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
                <input type="submit" name="update" value="Save" class="btn btn-success btn-block" style="background-color: #26A89A;">
                <a href="index.php" class="btn btn-secondary">Cancel</a>
              </div>
              <!-- /.col -->
            </div>
        </div>
        </div>
      </form>
      </div>
</body>
</html>