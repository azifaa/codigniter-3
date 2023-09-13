<?php
$servername ="localhost:3306";
$username_db = "root";                                                              
$password_bd = "";
$database_name = "db_sekolah";

$conn = new mysqli($servername, $username_db, $password_bd, $database_name);

if ($conn->connect_error) {
    die("koneksi database gagal: " . $conn->connect_error);
}
?>