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
    <title>Students</title>
    <link rel="stylesheet" href="students.css">
</head>
<body>
    <header>
        <a href="admin_home.php"><img src="./logonoback.png" width="55%" alt="logo"></a>
        <a href="../login.php" id="log_out">Log Out</a>
    </header>

    <div class="read-now" id="books">
        <div class="heading">
            Students Who Have Borrowed Books
        </div>
        <?php
        if ($result_borrow->num_rows > 0) {
            while ($row_borrow = $result_borrow->fetch_assoc()) {
                $borrowed_user_id = $row_borrow['brrw_id'];

                $sql_faculty = "SELECT * FROM `library_mgn_sys`.`faculty` WHERE `f_id` = $borrowed_user_id";
                $result_faculty = $conn->query($sql_faculty);
                // Fetch student or faculty details
                $sql_user = "SELECT * FROM `library_mgn_sys`.`student` WHERE `s_id` = $borrowed_user_id";
                $result_user = $conn->query($sql_user);

                if ($result_user->num_rows > 0) {
                    $row_user = $result_user->fetch_assoc();
                    ?>
                    <div class="box book-n">
                        <div class="box-content">
                            <h2><?php echo $row_user['s_name']; ?></h2>
                            <div class="box-btn">
                                <?php
                                // Fetch borrowed books
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
                                <p><strong>Email:</strong> <?php echo htmlspecialchars($row_user['s_email']); ?></p>
                                <p><strong>Phone:</strong> <?php echo htmlspecialchars($row_user['s_phone']); ?></p>
                                <p><strong>Degree:</strong> <?php echo htmlspecialchars($row_user['s_dept']); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                    
                }  else if($result_faculty->num_rows != 0){
                    echo '';
                }
                else{
                    echo '<div class="no_book" style="color: white; font-size: 1.5rem; font-weight: 100;">Student details not found</div>';
                }
            }
        } else {
            echo '<div class="no_book" style="color: white; font-size: 1.5rem; font-weight: 100;">Nobody has borrowed the books</div>';
        }
        ?>
    </div>

    <footer>
        © Book Verse  <script>document.write(new Date().getFullYear());</script>
    </footer>    
</body>
</html>
