<?php
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "Elox_Users";
$conn = "";
$conn_passed = true;

try {
    $conn = mysqli_connect(
        $db_server,
        $db_user,
        $db_pass,
        $db_name
    );
} catch (mysqli_sql_exception) {
    echo "no connection <br>";
    echo "check your internet or restart your computer";
    $conn_passed = false;
}