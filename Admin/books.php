<?php
include 'dbconnect_admin.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_book_id'])) {
    $book_id = $_POST['delete_book_id'];
    $sql_delete = "DELETE FROM `library_mgn_sys`.`book` WHERE `book_id` = '$book_id'";
    if ($conn->query($sql_delete) === TRUE) {
        echo "Book deleted successfully.";
    } else {
        echo "Error deleting book: " . $conn->error;
    }
    exit(); // Stop further execution
}

$sql = "SELECT * FROM `library_mgn_sys`.`book`";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
    <link rel="stylesheet" href="books.css">
</head>

<body>
    <header>
        <a href="admin_home.php"><img src="./logonoback.png" style="width: 125px; align-self: flex-start;" alt="logo"></a>
        <a href="../login.php" id="log_out">Log Out</a>
    </header>

    <div class="read-now" id="books">
        <div class="heading">
            Listed Books
        </div>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="box book-n" data-book-id="<?php echo htmlspecialchars($row['book_id']); ?>">
                    <div class="box-content">
                        <div class="box-img">
                            <img src="../book-images/<?php echo htmlspecialchars($row['book_id']) . '.png'; ?>" alt="<?php echo htmlspecialchars($row['book_name']); ?>">
                        </div>
                        <h2><?php echo $row['book_name']; ?></h2>
                        <div class="box-btn">
                            <p><strong>Author:</strong> <?php echo htmlspecialchars($row['author']); ?></p>
                            <p><strong>Publication Year:</strong> <?php echo htmlspecialchars($row['pub_year']); ?></p>
                            <p><strong>Genre:</strong> <?php echo htmlspecialchars($row['genre']); ?></p>
                            <button class="del_btn">Delete Book</button>
                        </div>
                    </div>
                </div>
            <?php
            }
        } else {
            echo '<div class="no_book" style="color: white; font-size: 1.5rem; font-weight: 100;">No books listed</div>';
        }
        ?>
    </div>

    <footer>
        © Book Verse <script>
            document.write(new Date().getFullYear());
        </script>
    </footer>

    <script>
        // Function to delete a book via AJAX
        function deleteBook(bookId) {
            if (confirm('Are you sure you want to delete this book?')) {
                const xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                        alert(this.responseText);
                        location.reload(); // Refresh the page after deletion
                    }
                };
                xhr.open('POST', 'delete_book.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('delete_book_id=' + bookId);
            }
        }

        // Attach event listeners to all delete buttons
        const deleteButtons = document.querySelectorAll('.del_btn');
        deleteButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const bookId = this.closest('.box').dataset.bookId;
                deleteBook(bookId);
            });
        });
    </script>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>
