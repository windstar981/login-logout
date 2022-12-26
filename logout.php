<?php
include('config/db_connect.php');

session_start();
session_destroy();
setcookie("email", null, time() - 3600 * 24 * 30);
setcookie("password", null, time() - 3600 * 24 * 30);

header("Location: index.php");
