CREATE TABLE `library_mgn_sys`.`admin` (
  `ad_id` INT NOT NULL ,
  `ad_name` VARCHAR(255) NOT NULL,
  `ad_email` VARCHAR(255) NOT NULL,
  `ad_phone` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`ad_id`),
  UNIQUE KEY `ad_name_UNIQUE` (`ad_name`)
);


CREATE TABLE `library_mgn_sys`.`book` (
  `book_id` INT NOT NULL ,
  `book_name` VARCHAR(255) NOT NULL,
  `author` VARCHAR(255) NOT NULL,
  `pub_year` INT NOT NULL,
  `genre` VARCHAR(255) NOT NULL,
  `dt` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`book_id`),
);


CREATE TABLE `library_mgn_sys`.`student` (
  `s_id` INT NOT NULL ,
  `s_name` VARCHAR(255) NOT NULL,
  `s_email` VARCHAR(255) NOT NULL,
  `s_phone` VARCHAR(20) NOT NULL,
  `s_dept` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`s_id`),
  UNIQUE KEY `s_name_UNIQUE` (`s_name`)
);


CREATE TABLE faculty (
    `f_id` INT PRIMARY KEY ,
    `f_name` VARCHAR(255) NOT NULL,
    `f_email` VARCHAR(255) NOT NULL,
    `f_phone` VARCHAR(20) NOT NULL,
    `d_id` INT,
    -- Foreign key constraint
    FOREIGN KEY (d_id) REFERENCES department(dept_id)
);



CREATE TABLE `library_mgn_sys`.`borrow` (
  `brrw_id` INT NOT NULL,
  `stud_id` INT NOT NULL,
  `facut_id` INT NOT NULL,
  `bk_id` INT NOT NULL,
  `brrw_date` DATE NOT NULL,
  `due_date` DATE NOT NULL,
  `dt` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`stud_id`) REFERENCES `student`(`s_id`),
  FOREIGN KEY (`facut_id`) REFERENCES `faculty`(`f_id`),
  FOREIGN KEY (`bk_id`) REFERENCES `book`(`book_id`)
);

CREATE TABLE department (
    `dept_id` INT PRIMARY KEY,
    `dept_name` VARCHAR(50) NOT NULL,
    `dept_email` VARCHAR(20) NOT NULL,
    `dept_loc` VARCHAR(20) NOT NULL,
    `dept_phone` VARCHAR(15) NOT NULL,
    `hod_id` INT, 
);

CREATE TABLE works_in (
    `fact_id` INT NOT NULL ,
    `depart_id` INT NOT NULL ,
    FOREIGN KEY (`fact_id`) REFERENCES `faculty`(`f_id`),
    FOREIGN KEY (`depart_id`) REFERENCES `department`(`depart_id`),
);


-- Insert the new book by checking existing book ID
CREATE VIEW book_data AS
SELECT '$book_id' AS book_id,
       '$book_name' AS book_name,
       '$author' AS author,
       '$pub_year' AS pub_year,
       '$genre' AS genre,
       current_timestamp() AS dt;

INSERT INTO `library_mgn_sys`.`book` (`book_id`, `book_name`, `author`, `pub_year`, `genre`, `dt`)
SELECT * `book_data`
WHERE NOT EXISTS (
    SELECT * FROM `library_mgn_sys`.`book` WHERE `book_id` = '$BookId'
) LIMIT 1;


-- Delete book from book table of admin want to delete certain book 
DELETE FROM `library_mgn_sys`.`book` WHERE `book_id` = '$book_id'  -- $book_id = id of book that admin want to delete


-- insertion of a borrow record into the borrows table, by checking various things like whether the user and book exist, whether the book is already borrowed, etc.:
CREATE VIEW Borrow_data AS
SELECT '$userid' AS brrw_id,
       '$bookid' AS bk_id,
       '$borrowDate' AS brrw_date,
       '$dueDate' AS due_date,
       current_timestamp() AS dt;


INSERT INTO `library_mgn_sys`.`borrows` (`brrw_id`, `bk_id`, `brrw_date`, `due_date`, `dt`)
SELECT * FROM `Borrow_data`
WHERE EXISTS (
    SELECT * FROM `library_mgn_sys`.`book` WHERE `book_id` = '$bookid'
    AND NOT EXISTS (
        SELECT * FROM `library_mgn_sys`.`borrows` WHERE `brrw_id` = '$userid'
    )
) LIMIT 1;




-- Select all books borrowed by a student with their details (using JOIN):

SELECT s.s_name, s.s_email, s.s_dept, b.book_name, b.author, b.pub_year, bs.brrw_date, bs.due_date
FROM borrow bs
JOIN student s ON bs.brrw_id = s.s_id
JOIN book b ON bs.bk_id = b.book_id


-- Select all books borrowed by a faculty member with their details (using JOIN):

SELECT f.f_name AS faculty_name, b.book_name, b.author, b.pub_year, bs.brrw_date, bs.due_date
FROM borrow bs
JOIN faculty f ON bs.brrw_id = f.f_id
JOIN book b ON bs.bk_id = b.book_id


-- Select all books borrowed by a specific user (student or faculty) with their details (using UNION):

SELECT s.s_name AS student_name, b.book_name, b.author, b.pub_year, bs.brrw_date, bs.due_date
FROM borrow bs
JOIN student s ON bs.brrw_id = s.s_id
JOIN book b ON bs.bk_id = b.book_id

UNION

SELECT f.f_name AS faculty_name, b.book_name, b.author, b.pub_year, bs.brrw_date, bs.due_date
FROM borrow bs
JOIN faculty f ON bs.brrw_id = f.f_id
JOIN book b ON bs.bk_id = b.book_id


-- Displaying all the books in academic books faculty
SELECT * FROM `library_mgn_sys`.`book`


-- Insert the new faculty details by checking if there is existing faculty name and ID or not
CREATE VIEW faculty_data AS
SELECT '$f_id' AS f_id,
       '$f_name' AS f_name,
       '$f_email' AS f_email,
       '$f_phone' AS f_phone,
       '$f_d_id' AS f_d_id,
       current_timestamp() AS dt;

INSERT INTO `library_mgn_sys`.`faculty` (`f_id`,`f_name`, `f_email`, `f_phone`, `d_id`, `password`, `cpassword`, `dt`) 
SELECT * FROM (SELECT '$f_id', '$f_name', '$f_email', '$f_phone', '$f_d_id', current_timestamp()) AS temp
WHERE NOT EXISTS (
    SELECT * FROM `library_mgn_sys`.`faculty` WHERE `f_name` = '$faculty_name'
    AND NOT EXISTS (
        SELECT * FROM `library_mgn_sys`.`faculty` WHERE `f_id` = '$faculty_id'
    )
) LIMIT 1;


-- Insert the new student details by checking if there is existing student name and ID or not
CREATE VIEW student_data AS
SELECT '$s_id' AS s_id,
       '$s_name' AS s_name,
       '$s_email' AS s_email,
       '$s_phone' AS s_phone,
       '$s_d_dept' AS s_d_id,
       current_timestamp() AS dt;

INSERT INTO `library_mgn_sys`.`student` (`s_id` ,`s_name`, `s_email`, `s_phone`, `s_dept`, `password`, `cpassword`,`dt`) 
SELECT * `student_data`
WHERE NOT EXISTS (
    SELECT * FROM `library_mgn_sys`.`student` WHERE `s_name` = '$student_name'
    AND NOT EXISTS (
        SELECT * FROM `library_mgn_sys`.`student` WHERE `s_id` = '$student_id'
    )
) LIMIT 1;
