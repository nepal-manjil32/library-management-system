<?php
// session_start();

// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
//     header("location: create_ac_stud.php");
//     exit;
// }

include './Admin/dbconnect_admin.php'; // Include the database connection file

// SQL query to fetch books from the database
$sql = "SELECT * FROM `library_mgn_sys`.`book`";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookVerse</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <div class="navbar">
            <div class="nav-center">
                <a href="./index_student.php"><img src="logo.png" alt="BookVerse logo" class="logo"></a>
            </div>
        
            <div class="nav-right">
                <!-- <i class="fa-solid fa-book-bookmark" style="color: #ffffff;"></i> -->
                <h4><a href="./index_student.php" class="border">Home</a></h4>
                <h4><a href="#books" class="border">New Arrivals</a></h4>
                <h4><a href="./academic-books-student.php" class="border">Academic Books</a></h4>
                <h4><a href="#footer" class="border">Contact Us</a></h4>
                <h4><a href="login.php" class="logout" style="color:rgb(170, 70, 70);">Log Out</a></h4>
            </div>
        </div>
    </header>

    <main>
        <div class="content">
            <div class="content1">
                <p>Discover the latest <br>and greatest books <br>online</p>
            </div>
            <div class="content2">
                <p>Explore our vast collection of books and find your next favorite read.</p>
            </div>
            <div class="content3">
                <a href="#books"><button class="shop">Read</button></a>
                <a href="./academic-books-student.php" class="learn">Learn More</a>
            </div>
        </div>
        <div class="read-now" id="books">
            <div class="heading">
                New Arrivals
            </div>

            <!-- <div class="box book-1">
                <div class="box-content">
                    <div class="box-img">
                        <img src="./book-images/1.png" alt="">
                    </div>
                    <h2>Rich Dad Poor Dad</h2>
                    <div class="box-btn">
                        <a href="#">Read Now</a>
                        <a href="./Admin/borrowBook_student.php">Borrow</a>
                    </div>
                </div>
            </div>
            <div class="box book-2">
                <div class="box-content">
                    <div class="box-img">
                        <img src="./book-images/2.png" alt="">
                    </div>
                    <h2>Atomic Habits</h2>
                    <div class="box-btn">
                        <a href="#">Read Now</a>
                        <a href="./Admin/borrowBook_student.php">Borrow</a>
                    </div>
                </div>
            </div>
            <div class="box book-3">
                <div class="box-content">
                    <div class="box-img">
                        <img src="./book-images/3.png" alt="">
                    </div>
                    <h2>Psychology of Money</h2>
                    <div class="box-btn">
                        <a href="#">Read Now</a>
                        <a href="./Admin/borrowBook_student.php">Borrow</a>
                    </div>
                </div>
            </div>
            <div class="box book-4">
                <div class="box-content">
                    <div class="box-img">
                        <img src="./book-images/4.png" alt="">
                    </div>
                    <h2>Book Name</h2>
                    <div class="box-btn">
                        <a href="#">Read Now</a>
                        <a href="./Admin/borrowBook_student.php">Borrow</a>
                    </div>
                </div>
            </div>
            <div class="box book-5">
                <div class="box-content">
                    <div class="box-img">
                        <img src="./book-images/5.png" alt="">
                    </div>
                    <h2>Book Name</h2>
                    <div class="box-btn">
                        <a href="#">Read Now</a>
                        <a href="./Admin/borrowBook_student.php">Borrow</a>
                    </div>
                </div>
            </div>
            <div class="box book-6">
                <div class="box-content">
                    <div class="box-img">
                        <img src="./book-images/6.png" alt="">
                    </div>
                    <h2>Book Name</h2>
                    <div class="box-btn">
                        <a href="#">Read Now</a>
                        <a href="./Admin/borrowBook_student.php">Borrow</a>
                    </div>
                </div>
            </div>
            <div class="box book-6">
                <div class="box-content">
                    <div class="box-img" >
                        <img src="./book-images/7.png" alt="">
                    </div>
                    <h2>Book Name</h2>
                    <div class="box-btn">
                        <a href="#">Read Now</a>
                        <a href="./Admin/borrowBook_student.php">Borrow</a>
                    </div>
                </div>
            </div>
            <div class="box book-6">
                <div class="box-content">
                    <div class="box-img">
                        <img src="./book-images/8.png" alt="">
                    </div>
                    <h2>Book Name</h2>
                    <div class="box-btn">
                        <a href="#">Read Now</a>
                        <a href="./Admin/borrowBook_student.php">Borrow</a>
                    </div>
                </div>
            </div>
            <div class="box book-6">
                <div class="box-content">
                    <div class="box-img">
                        <img src="./book-images/8.png" alt="">
                    </div>
                    <h2>Book Name</h2>
                    <div class="box-btn">
                        <a href="#">Read Now</a>
                        <a href="./Admin/borrowBook_student.php">Borrow</a>
                    </div>
                </div>
            </div>
            <div class="box book-6">
                <div class="box-content">
                    <div class="box-img">
                        <img src="./book-images/8.png" alt="">
                    </div>
                    <h2>Book Name</h2>
                    <div class="box-btn">
                        <a href="#">Read Now</a>
                        <a href="./Admin/borrowBook_student.php">Borrow</a>
                    </div>
                </div>
            </div>
            <div class="box book-6">
                <div class="box-content">
                    <div class="box-img">
                        <img src="./book-images/8.png" alt="">
                    </div>
                    <h2>Book Name</h2>
                    <div class="box-btn">
                        <a href="#">Read Now</a>
                        <a href="./Admin/borrowBook_student.php">Borrow</a>
                    </div>
                </div>
            </div>
            <div class="box book-6">
                <div class="box-content">
                    <div class="box-img">
                        <img src="./book-images/8.png" alt="">
                    </div>
                    <h2>Book Name</h2>
                    <div class="box-btn">
                        <a href="#">Read Now</a>
                        <a href="./Admin/borrowBook_student.php">Borrow</a>
                    </div>
                </div>
            </div> -->
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="box book-n">
                        <div class="box-content">
                            <div class="box-img">
                                <img src="./book-images/<?php echo htmlspecialchars($row['book_id']) . '.png'; ?>" alt="<?php echo htmlspecialchars($row['book_name']); ?>">
                            </div>
                            <h2><?php echo $row['book_name']; ?></h2>
                            <div class="box-btn">
                                <a href="#">Read Now</a>
                                <a href="./Admin/borrowBook.php">Borrow</a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<div class="no_book" style="color: white; font-size: 1.5rem; font-weight: 100;">No Other books found</div>';
            }
            ?>
        </div>
    </main>

    <footer id="footer">
        <div style="display: flex; 
                    justify-content: flex-start; 
                    flex-direction: column; 
                    gap: 15px; 
                    align-items: center;">
            <a href="#mailto">
                <div style="display: flex; align-items: center; gap: 1rem; margin-left: 3rem;">
                    <img src="./social_images/blackemail.png" width="35px"> 
                    <p> book.verse@customer.np</p>
                </div>
            </a>
            <a href="#mailto" style="padding: 0 1rem 0 1rem;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <img src="./social_images/call.png" width="35px"> 
                    <p> +91-9502908870 </p>
                </div>
            </a>
            <a href="#mailto">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <img src="./social_images/call.png" width="35px"> 
                    <p> +91-9502908870 </p>
                </div>
            </a>
        </div>
        <div style=" font-size: larger;">
            <p>Mars Colony Alpha, Surface Habitat Module 3, Mars Base, Valles Marineris, Mars</p>
            <p>© Book Verse  <script>document.write(new Date().getFullYear());</script></p>
        </div>
        <div style="display: flex; flex-direction: column; gap: 15px;">
            <a href="#"><img src="./social_images/fb.png" width="35px"></a>
            <a href="#"><img src="./social_images/insta.webp" width="35px"></a>
            <a href="#"><img src="./social_images/linkedin.png" width="35px"></a>
        </div>
    </footer>   
</body>

</html>