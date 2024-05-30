<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include './Admin/dbconnect_admin.php';
    $s_id = $_POST['id'];
    $username = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $degree = $_POST["degree"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    // $exists=false;

    // Check whether this username exists
    $existSql = "SELECT * FROM `student` WHERE s_name = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        // $exists = true;
        $showError = "Username Already Exists";
    }
    else{
        // $exists = false; 
        if(($password == $cpassword)){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `library_mgn_sys`.`student` (`s_id` ,`s_name`, `s_email`, `s_phone`, `s_dept`, `password`, `cpassword`,`dt`) VALUES ('$s_id', '$username', '$email', '$phone', '$degree', '$password', '$cpassword', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result){
                $showAlert = true;
            }
        }
        else{
            $showError = "Passwords do not match";
        }
    }
}
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Document</title>
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
  if ($showAlert) {
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is now created and you can login
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
    <form action="create_ac_stud.php" method="post" style="background-color: #222831; border: 1px solid rgb(255, 255, 255);">
      <p class="head">Create Account for Student</p>

      <!-- id -->
      <div data-mdb-input-init class="form-outline mb-4">
        <input type="text" id="student_id" class="form-control" name="id" required style="color: white;">
        <label class="form-label" for="student_id" style="font-weight: 700;">Student ID</label>
      </div>

      <!-- Name -->
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

      <!-- Degree -->
      <div data-mdb-input-init class="form-outline mb-4">
        <input type="text" id="degree" class="form-control" name="degree" required style="color: white;">
        <label class="form-label" for="degree" style="font-weight: 700;">Degree</label>
      </div>

      <!-- Password input with show/hide option -->
      <div data-mdb-input-init class="form-outline mb-4" style="display: flex;">
        <input type="password" id="passwordInput" class="form-control" name="password" required min="8" style="color: white;">
        <label class="form-label" for="passwordInput" style="font-weight: 700;">Password</label>
        <button type="button" id="togglePassword" class="btn btn-sm btn-outline-secondary" onclick="togglePasswordVisibility(this)" style="border: none; background-color:rgb(0,0,0,0);">
          <i class="fas fa-eye"></i>
        </button>
      </div>

      <!-- Confirm Password input with show/hide option -->
      <div data-mdb-input-init class="form-outline mb-4" style="display: flex;">
        <input type="password" id="cpasswordInput" class="form-control" name="cpassword" required min="8" style="color: white;">
        <label class="form-label" for="cpasswordInput" style="font-weight: 700;">Confirm Password</label>
        <button type="button" id="toggleCPassword" class="btn btn-sm btn-outline-secondary" onclick="togglePasswordVisibility(this)" style="border: none; background-color:rgb(0,0,0,0);">
          <i class="fas fa-eye"></i>
        </button>
      </div>

      <!-- Submit button -->
      <button type="submit" class="btn btn-primary btn-block mb-4">Register</button>

    </form>
  </main>
  <!-- Font Awesome -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
  <!-- Toggle password visibility script -->
  <script>
    function togglePasswordVisibility(btn) {
      const inputId = btn.id === 'togglePassword' ? 'passwordInput' : 'cpasswordInput';
      const input = document.getElementById(inputId);
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
  <!-- MDB -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>