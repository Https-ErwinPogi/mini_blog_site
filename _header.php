<header class="p-3" style="background-color: #4267B2">
  <div class="d-flex">
      
      <div class="flex-grow-1">
      <h3 class="text-white">MiniBlog</h3>
      </div>
      <div class="p-2 h-stack gap-3">
                <?php if (isset($_SESSION['session']) && !empty($_SESSION['session'])) {
                ?>
                <?php include_once("config.php");
                  $stmtselect = "Select * FROM users WHERE id=".$_SESSION['id']."";
                  $result = mysqli_query($conn, $stmtselect);
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo "<span class='text-white'>$row[username]</span>";
                  }?>
                  <a href="index.php" class="text-white text-decoration-none">Home</a>
                    <a href="index.php?logout=true" onclick="return confirm('Are you sure to logout?');" class="text-white text-decoration-none">Logout</a>
                <?php } else { ?>
                    <a href="login_page.php" class="text-white text-decoration-none">Login</a>
                <?php } ?>
            </div>
      </div>
    </div>
    </header>