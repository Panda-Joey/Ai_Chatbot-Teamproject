<?php
$db_host = 'teamai-db';
$db_user = 'aibutler_user';
$db_pass = 'password';
$db_name = 'aibutler_db';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
