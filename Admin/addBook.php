<?php
$showAlert = false;
$showError = false;
include 'dbconnect_admin.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $BookId = $_POST["id"];
    $BookName = $_POST["name"];
    $Author = $_POST["author"];
    $PublicationYear = $_POST["year"];
    $Genre = $_POST["genre"];

    // Check if the book with the same BookId already exists
    $exist_book = "SELECT * FROM `library_mgn_sys`.`book` WHERE book_id = '$BookId'";
    $result = $conn->query($exist_book);
    if ($result->num_rows > 0) {
        $showError = "Book with the same ID already exists. Please choose a different ID.";
    } else {
        $sql = "INSERT INTO `library_mgn_sys`.`book` (`book_id`, `book_name`, `author`, `pub_year`, `genre`, `dt`) VALUES ('$BookId', '$BookName', '$Author', '$PublicationYear', '$Genre', current_timestamp())";

        if ($conn->query($sql) === TRUE) {
            $showAlert = true;
        } else {
            $showError = "Error adding book: " . $conn->error;
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
    <title>Add Book</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="addBook.css">
</head>

<body>
    <header>
        <a href="admin_home.php"><img src="./logonoback.png"  style="width: 125px; align-self: flex-start;" alt="logo"></a>
        <div id="add-book">
            <img src="./add.png" width="60%">
            <p style="font-size: 15px; font-weight: bold;">Add Book</p>
        </div>
        <a href="../login.php" id="log_out">Log Out</a>
    </header>

    <?php
    if ($showAlert) {
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Book is successfully added
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
        <form action="addBook.php" method="post">
            <label for="id">Book ID</label>
            <input type="text" id="id" name="id">

            <label for="name">Book Name</label>
            <input type="text" id="name" name="name">

            <label for="author">Author</label>
            <input type="text" id="author" name="author">

            <label for="year">Publication Year</label>
            <input type="number" id="year" name="year" min="1999" max="2024">

            <label for="genre">Genre</label>
            <input type="text" id="genre" name="genre">

            <button type="submit">Submit</button>
        </form>
    </section>

    <footer>
        © Book Verse <script>
            document.write(new Date().getFullYear());
        </script>
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>
