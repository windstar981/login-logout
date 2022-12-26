<?php

//connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'pet_project');

// check connection
if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
}
