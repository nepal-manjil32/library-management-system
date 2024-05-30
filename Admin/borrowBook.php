<?php
$showAlert = false;
$showError = false;
include 'dbconnect_admin.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $userid = $_POST["userid"];
    $bookid = $_POST["bookid"];
    $borrowDate = $_POST["borrowDate"];
    $dueDate = $_POST["dueDate"];

    // Check if the user ID exists in either the student or faculty table
    $exist_stud = "SELECT * FROM `library_mgn_sys`.`student` WHERE s_id = '$userid'";
    $exist_faculty = "SELECT * FROM `library_mgn_sys`.`faculty` WHERE f_id = '$userid'";
    $exist_student_query = mysqli_query($conn, $exist_stud);
    $exist_faculty_query = mysqli_query($conn, $exist_faculty);

    if (mysqli_num_rows($exist_faculty_query) == 0 && mysqli_num_rows($exist_student_query) == 0) 
    {
        $showError = "No user found with ID: $userid";
    } 
    else 
    {
        // Check if the book ID exists in the book table
        $exist_book = "SELECT * FROM `library_mgn_sys`.`book` WHERE book_id = '$bookid'";
        $exist_book_query = mysqli_query($conn, $exist_book);
        if (mysqli_num_rows($exist_book_query) > 0) 
        {
            // Check if the book is already borrowed
            $existSql = "SELECT * FROM `library_mgn_sys`.`borrows` WHERE brrw_id = '$userid'";
            $result = mysqli_query($conn, $existSql);
            $numExistRows = mysqli_num_rows($result);
            if ($numExistRows > 0)
            {
                $showError = "Book is Already Borrowed";
            } 
            else 
            {
                // Insert the borrow record
                $sql = "INSERT INTO `library_mgn_sys`.`borrows` (`brrw_id`, `bk_id`, `brrw_date`, `due_date`, `dt`) VALUES ('$userid', '$bookid', '$borrowDate', '$dueDate', current_timestamp())";
                $result = mysqli_query($conn, $sql);
                if ($result) 
                {
                    $showAlert = true;
                }
            }
        } 
        else 
        {
            // Book does not exist, show error
            $showError = "Book ID is not present";
        }
    }

    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrow Book</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="borrowBook.css">
</head>

<body>
    <header>
        <a href="admin_home.php"><img src="./logonoback.png"alt="logo" style="width: 125px; align-self: flex-start;"></a>
        <div id="add-book">
            <img src="./borrow.png" width="60%">
            <p style="font-size: 15px; font-weight: bold;">Borrow</p>
        </div>
        <a href="../login.php" id="log_out">Log Out</a>
    </header>

    <?php
    if ($showAlert) {
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Book is successfully Borrowed
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

    <section id="central-form">
        <p style="font-size: 2rem; color: white;">Borrow Book For Student/Faculty</p>
        <form action="borrowBook.php" method="post">
            <label for="id">Student/Faculty ID</label>
            <input type="int" id="id" name="userid">

            <label for="name">Book ID</label>
            <input type="text" id="name" name="bookid">

            <label for="borrow-date">Borrow Date</label>
            <input type="date" id="borrow-date" name="borrowDate">

            <label for="due-date">Due Date</label>
            <input type="date" id="due-date" name="dueDate">

            <button type="submit">Submit</button>
        </form>
    </section>

    <footer>
        © Book Verse <script>
            document.write(new Date().getFullYear());
        </script>
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>