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
}

$conn->close();
?>
