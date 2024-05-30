<?php
// Include the database connection file
include './Admin/dbconnect_admin.php';

// SQL query to fetch books from the database
$sql = "SELECT * FROM `library_mgn_sys`.`book`";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Books</title>
    <link rel="stylesheet" href="academic-books.css">
</head>
<body>
    <header>
        <div class="navbar">
            <div class="nav-left">
                <a href="./index_faculty.php"><img src="logo.png" alt="BookVerse logo" class="logo"></a>
            </div>
            <div class="nav-right">
                <h4><a href="./index_faculty.php" class="border">Home</a></h4>
                <h4><a href="./index_faculty.php#books" class="border">New Arrivals</a></h4>
                <h4><a href="./academic-books.php" class="border">Academic Books</a></h4>
                <h4><a href="#footer" class="border">Contact Us</a></h4>
                <h4><a href="login.php" class="logout" style="color:rgb(170, 70, 70);;">Log Out</a></h4>
            </div>
        </div>
    </header>

    <main>
        <table>
            <tr>
                <th>ID</th>
                <th>Book Name</th>
                <th>Book Author</th>
                <th>Publication Year</th>
                <th>Genre</th>
                <th style="padding: 0 3rem 0 3rem;"></th>
            </tr>

            <!-- <tr>
                <td>00001</td>
                <td>Engineering Physics</td>
                <td>Stephen Hawking</td>
                <td>2003</td>
                <td>Academic</td>
                <td><a href="./Admin/borrowBook.php">Borrow</a></td>
              </tr>
              <tr>
                <td>00002</td>
                <td>The Elegant Universe: Quest for the Ultimate Theory</td>
                <td>Brian Greene</td>
                <td>1999</td>
                <td>Physics</td>
                <td><a href="./Admin/borrowBook.php">Borrow</a></td>
              </tr>
              <tr>
                <td>00003</td>
                <td>Fundamentals of Physics</td>
                <td>David Halliday, Robert Resnick, Jearl Walker</td>
                <td>2005</td>
                <td>Physics</td>
                <td><a href="./Admin/borrowBook.php">Borrow</a></td>
              </tr>
              <tr>
                <td>00004</td>
                <td>Introduction to Electrodynamics</td>
                <td>David J. Griffiths</td>
                <td>2017</td>
                <td>Physics</td>
                <td><a href="./Admin/borrowBook.php">Borrow</a></td>
              </tr>
              <tr>
                <td>00005</td>
                <td>Classical Mechanics</td>
                <td>Herbert Goldstein, Charles P. Poole, John L. Safko</td>
                <td>2002</td>
                <td>Physics</td>
                <td><a href="./Admin/borrowBook.php">Borrow</a></td>
              </tr>
              <tr>
                <td>00006</td>
                <td>Quantum Mechanics: Concepts and Applications</td>
                <td>Nouredine Zettili</td>
                <td>2018</td>
                <td>Physics</td>
                <td><a href="./Admin/borrowBook.php">Borrow</a></td>
              </tr>
              <tr>
                <td>00007</td>
                <td>Chemical Engineering Principles</td>
                <td>Fogler, H. Scott</td>
                <td>2016</td>
                <td>Chemical Engineering</td>
                <td><a href="./Admin/borrowBook.php">Borrow</a></td>
              </tr>
              <tr>
                <td>00008</td>
                <td>Biochemistry</td>
                <td>Jeremy M. Berg, John L. Tymoczko, Lubert Stryer</td>
                <td>2010</td>
                <td>Biochemistry</td>
                <td><a href="./Admin/borrowBook.php">Borrow</a></td>
              </tr>
              <tr>
                <td>00009</td>
                <td>Electrical Engineering: Principles and Applications</td>
                <td>Allan R. Hambley</td>
                <td>2018</td>
                <td>Electrical Engineering</td>
                <td><a href="./Admin/borrowBook.php">Borrow</a></td>
              </tr>
              <tr>
                <td>00010</td>
                <td>Computer Organization and Design: The Hardware/Software Interface</td>
                <td>David A. Patterson, John L. Hennessy</td>
                <td>2017</td>
                <td>Computer Science</td>
                <td><a href="./Admin/borrowBook.php">Borrow</a></td>
              </tr>
              <tr>
                <td>00011</td>
                <td>Introduction to Algorithms</td>
                <td>Thomas H. Cormen, Charles E. Leiserson, Ronald L</td>
                <td>2009</td>
                <td>Computer Science</td>
                <td><a href="./Admin/borrowBook.php">Borrow</a></td>
              </tr>
              <tr>
                <td>00012</td>
                <td>Environmental Engineering</td>
                <td>Howard S. Peavy, Donald R. Rowe, George Tchobanoglous</td>
                <td>2016</td>
                <td>Environmental Engineering</td>
                <td><a href="./Admin/borrowBook.php">Borrow</a></td>
              </tr>
              <tr>
                <td>00013</td>
                <td>Molecular Biology of the Cell</td>
                <td>Bruce Alberts, Alexander Johnson, Julian Lewis, David Morgan, Martin Raff, Keith Roberts, Peter Walter</td>
                <td>2014</td>
                <td>Biology</td>
                <td><a href="./Admin/borrowBook.php">Borrow</a></td>
              </tr>
              <tr>
                <td>00014</td>
                <td>Materials Science and Engineering: An Introduction</td>
                <td>William D. Callister Jr., David G. Rethwisch</td>
                <td>2017</td>
                <td>Materials Science</td>
                <td><a href="./Admin/borrowBook.php">Borrow</a></td>
              </tr>
              <tr>
                <td>00015</td>
                <td>Genetics: Analysis and Principles</td>
                <td>Robert J. Brooker</td>
                <td>2019</td>
                <td>Genetics</td>
                <td><a href="./Admin/borrowBook.php">Borrow</a></td>
              </tr>
              <tr>
                <td>00016</td>
                <td>Statics and Mechanics of Materials</td>
                <td>Russell C. Hibbeler</td>
                <td>2014</td>
                <td>Civil Engineering</td>
                <td><a href="./Admin/borrowBook.php">Borrow</a></td>
              </tr>
              <tr>
                <td>00017</td>
                <td>Introduction to Thermal and Fluid Engineering</td>
                <td>Deborah A. Kaminski, Michael K. Jensen</td>
                <td>2015</td>
                <td>Mechanical Engineering</td>
                <td><a href="./Admin/borrowBook.php">Borrow</a></td>
              </tr>
              <tr>
                <td>00018</td>
                <td>Neural Networks and Deep Learning: A Textbook</td>
                <td>Charu C. Aggarwal</td>
                <td>2018</td>
                <td>Artificial Intelligence</td>
                <td><a href="./Admin/borrowBook.php">Borrow</a></td>
              </tr>
              <tr>
                <td>00019</td>
                <td>Introduction to Probability Models</td>
                <td>Sheldon M. Ross</td>
                <td>2019</td>
                <td>Probability Theory</td>
                <td><a href="./Admin/borrowBook.php">Borrow</a></td>
              </tr>
              <tr>
                <td>00020</td>
                <td>Geotechnical Engineering: Principles and Practices</td>
                <td>Donald P. Coduto, Man-chu Ronald Yeung, William A. Kitch</td>
                <td>2010</td>
                <td>Geotechnical Engineering</td>
                <td><a href="./Admin/borrowBook.php">Borrow</a></td>
              </tr> -->

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['book_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['book_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['author']); ?></td>
                        <td><?php echo htmlspecialchars($row['pub_year']); ?></td>
                        <td><?php echo htmlspecialchars($row['genre']); ?></td>
                        <td><a href="./Admin/borrowBook.php">Borrow</a></td>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="6">No Other books found</td></tr>';
            }
            ?>
        </table>
    </main>

    <footer id="footer">
        <div style="display: flex; justify-content: flex-start; flex-direction: column; gap: 15px; align-items: center;">
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
        <div style="font-size: larger;">
            <p>Mars Colony Alpha, Surface Habitat Module 3, Mars Base, Valles Marineris, Mars</p>
            <p>© Book Verse  <script>document.write(new Date().getFullYear());</script></p>
        </div>
        <div style="display: flex; flex-direction: column; gap: 15px;">
            <a href="#"><img src="./social_images/fb.png" width="35px"></a>
            <a href="#"><img src="./social_images/insta.webp" width="35px"></a>
            <a href="#"><img src="./social_images/linkedin.png" width="35px"></a>
        </div>
    </footer>   

    <!-- Close the database connection -->
    <?php $conn->close(); ?>
</body>
</html>
