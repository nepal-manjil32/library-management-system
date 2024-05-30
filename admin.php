<?php
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include './Admin/dbconnect_admin.php';
    $username = $_POST["name"];
    $password = $_POST["password"]; 
    
     
    // $sql = "Select * from users where username='$username' AND password='$password'";
    $sql = "SELECT * FROM `admin` WHERE `ad_name`='Admin'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        while($row=mysqli_fetch_assoc($result)){
            if ($password == $row['password']){ 
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['ad_name'] = $username;
                header("location: ./Admin/admin_home.php");
            } 
            else{
                $showError = "Invalid Credentials";
            }
        }
        
    } 
    else{
        $showError = "Invalid Credentials";
    }
}
    
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Document</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="login.css">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet" />
</head>

<body style="background-color: #00ADB5">
  <?php
  if ($login) {
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You are logged in
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
  }
  if ($showError) {
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> ' . $showError . '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
  }
  ?>

  <div class="logo">
    <a href="login.php"><img src="logonoback.png" alt="book verse"></a>
  </div>

  <main>
    <form action="admin.php" method="post" style="background-color: #222831; border: 1px solid rgb(255, 255, 255);">
      <p class="head">Admin Login</p>

      <!-- id -->
      <div data-mdb-input-init class="form-outline mb-4">
        <input type="text" id="admin_id" class="form-control" name="id" required style="color: white;">
        <label class="form-label" for="admin_id" style="font-weight: 700;">Admin ID</label>
      </div>

      <!-- Username input -->
      <div data-mdb-input-init class="form-outline mb-4">
        <input type="text" id="Full name" class="form-control" name="name" required style="color: white;">
        <label class="form-label" for="Full name" style="font-weight: 700;">Full Name</label>
      </div>

      <!-- Email input -->
      <div data-mdb-input-init class="form-outline mb-4">
        <input type="email" id="form2Example1" class="form-control" name="email" required style="color: white;">
        <label class="form-label" for="form2Example1" style="font-weight: 700;">Email address</label>
      </div>

      <!-- Phone input -->
      <div data-mdb-input-init class="form-outline mb-4">
        <input type="text" id="phone" class="form-control" name="phone" required style="color: white;">
        <label class="form-label" for="phone" style="font-weight: 700;">Phone</label>
      </div>

      <!-- Password input -->
      <div data-mdb-input-init class="form-outline mb-4" style="display: flex;">
        <input type="password" id="passwordInput" class="form-control" name="password" required min="8" style="color: white;">
        <label class="form-label" for="passwordInput" style="font-weight: 700;">Password</label>
        <button type="button" id="togglePassword" class="btn btn-sm btn-outline-secondary" onclick="togglePasswordVisibility(this)" style="border: none; background-color:rgb(0,0,0,0);">
          <i class="fas fa-eye"></i>
        </button>
      </div>

      <!-- 2 column grid layout for inline styling -->
      <!-- <div class="row mb-4">
        <div class="col d-flex justify-content-center">
         
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
            <label class="form-check-label" for="form2Example31"> Remember me </label>
          </div>
        </div>

      </div> -->

      <!-- Submit button -->
      <button type="submit" class="btn btn-primary btn-block mb-4">Sign
        in</button>

      <!-- Register buttons -->
      <div class="text-center">
        <p>Not a member? <a href="login.php">Register</a></p>
      </div>
    </form>
  </main>
  <!-- MDB -->
  <!-- Font Awesome -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>

  <!-- Toggle password visibility script -->
  <script>
  function togglePasswordVisibility(btn) {
    const input = document.getElementById('passwordInput'); 
    const icon = btn.querySelector('i');

    if (input.type === 'password') {
      input.type = 'text';
      icon.classList.remove('fa-eye');
      icon.classList.add('fa-eye-slash');
    } else {
      input.type = 'password';
      icon.classList.remove('fa-eye-slash');
      icon.classList.add('fa-eye');
    }
  }
</script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>