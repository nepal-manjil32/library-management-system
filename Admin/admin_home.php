<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <header>
        <img src="./logonoback.png" width="10%" alt="logo">
        <a href="../login.php">Log Out</a>
    </header>

    <section id="central-content">
        <h1 style="color: white;">Welcome to the Admin Portal</h1>
        <div id="admin-methods">
            <a href="./books.php" target="_blank">
                <div id="book-listed">
                    <img src="./books.png" width="25%">
                    <p>Book Listed</p>
                </div>
            </a>
            <a href="./addBook.php" target="_blank">
                <div id="add-book">
                    <img src="./add.png" width="25%">
                    <p>Add Book</p>
                </div>
            </a>
            <a href="./borrowBook.php" target="_blank">
                <div id="borrow-book">
                    <img src="./borrow.png" width="25%">
                    <p>Borrow Student/Faculty</p>
                </div>
            </a>
            <a href="./students.php" target="_blank">
                <div id="students">
                    <img src="./graduate.png" width="25%">
                    <p>Students</p>
                </div>
            </a>
            <a href="./faculties.php" target="_blank">
                <div id="faculties">
                    <img src="./professor.png" width="25%">
                    <p>Faculties</p>
                </div>
            </a>
        </div>
    </section>

    <footer>
        © Book Verse  <script>document.write(new Date().getFullYear());</script>
    </footer>    
</body>
</html>