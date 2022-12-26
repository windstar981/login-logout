<?php
session_start();
if (isset($_SESSION['id'])) {
    if (empty($_POST['id_department'])) {
        //tra ve loi 1
        echo "No id";
        exit();
    } else {
        include('../config/db_connect.php');
        $id = $_POST['id_department'];
        $sql = "SELECT * FROM departments WHERE id = $id";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result)) {
            $name = $_POST['name'];
            $sql = "UPDATE departments SET name = '$name' WHERE id = $id";

            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "success";
                exit();
            } else {
                echo "No department exists";
                exit();
            }
        } else {
            echo "No department exists";
            exit();
        }
    }
}
?>