<?php
include './Admin/dbconnect_admin.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['departmentId'])) {
    $departmentId = $_POST['departmentId'];

    $sql = "SELECT * FROM `department` WHERE dept_id = '$departmentId'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'Department data not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>