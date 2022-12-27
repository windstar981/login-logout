<?php
if(isset($_POST['email']))
{
    include('../config/db_connect.php');
    $email = $_POST['email'];
    $query = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($conn, $query);
    if(mysqli_num_rows($res) > 0)
    {
        echo "exist";
    }
}
?>