<?php
include 'dbconnect_admin.php';

$sql_borrow = "SELECT * FROM `library_mgn_sys`.`borrows`";
$result_borrow = $conn->query($sql_borrow);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty</title>
    <link rel="stylesheet" href="students.css">
</head>

<body>
    <header>
        <a href="admin_home.php"><img src="./logonoback.png" width="55%" alt="logo"></a>
        <a href="../login.php" id="log_out">Log Out</a>
    </header>

    <div class="read-now" id="books">
        <div class="heading">
            Faculty Who Have Borrowed Books
        </div>
        <?php
        if ($result_borrow->num_rows > 0) {
            while ($row_borrow = $result_borrow->fetch_assoc()) {
                $borrowed_user_id = $row_borrow['brrw_id'];
                $sql_faculty = "SELECT * FROM `library_mgn_sys`.`faculty` WHERE `f_id` = $borrowed_user_id";
                $result_faculty = $conn->query($sql_faculty);
                $sql_student = "SELECT * FROM `library_mgn_sys`.`student` WHERE `s_id` = $borrowed_user_id";
                $result_student = $conn->query($sql_student);

                if ($result_faculty->num_rows > 0) {
                    $row_faculty = $result_faculty->fetch_assoc();
                    // Fetch department name based on department ID (d_id)
                    $dept_id = $row_faculty['d_id'];
                    $sql_department = "SELECT `dept_name` FROM `department` WHERE `dept_id` = $dept_id";
                    $result_department = $conn->query($sql_department);

                    if ($result_department->num_rows > 0) {
                        $row_department = $result_department->fetch_assoc();
                        $department_name = $row_department['dept_name'];
                    } else {
                        // Handle if department not found
                        $department_name = "Department Not Found";
                    }
                    ?>
                    <div class="box book-n">
                        <div class="box-content">
                            <h2><?php echo $row_faculty['f_name']; ?></h2>
                            <div class="box-btn">
                                <!-- Display borrowed books -->
                                <?php
                                $borrowed_books_sql = "SELECT * FROM `library_mgn_sys`.`borrows` WHERE `brrw_id` = $borrowed_user_id";
                                $borrowed_books_result = $conn->query($borrowed_books_sql);

                                if ($borrowed_books_result->num_rows > 0) {
                                    while ($row_book = $borrowed_books_result->fetch_assoc()) {
                                        $book_id = $row_book['bk_id'];
                                        $book_name_sql = "SELECT `book_name` FROM `library_mgn_sys`.`book` WHERE `book_id` = $book_id";
                                        $book_name_result = $conn->query($book_name_sql);
                                        $book_name_row = $book_name_result->fetch_assoc();
                                        ?>
                                        <p><strong>Book Name:</strong> <?php echo htmlspecialchars($book_name_row['book_name']); ?></p>
                                        <?php
                                    }
                                }
                                ?>

                                <!-- Display other faculty details -->
                                <p><strong>Email:</strong> <?php echo htmlspecialchars($row_faculty['f_email']); ?></p>
                                <p><strong>Phone:</strong> <?php echo htmlspecialchars($row_faculty['f_phone']); ?></p>
                                <p><strong>Department:</strong> <?php echo htmlspecialchars($department_name); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                    // Break out of the loop once faculty details are found and displayed
                } else if ($result_student->num_rows != 0) {
                    echo ''; // No action needed for students
                } else {
                    echo '<div class="no_book" style="color: white; font-size: 1.5rem; font-weight: 100;">Faculty details not found</div>';
                }
            }
        } else {
            echo '<div class="no_book" style="color: white; font-size: 1.5rem; font-weight: 100;">Nobody has borrowed the books</div>';
        }
        ?>
    </div>

    <footer>
        © Book Verse
        <script>document.write(new Date().getFullYear());</script>
    </footer>
</body>

</html>
