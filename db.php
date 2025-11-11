<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "ql_banhang";

$conn = new mysqli($host, $user, $pass, $dbname);
$conn->set_charset("utf8");

if ($conn->connect_error) {
    die(json_encode(["error" => "Kết nối thất bại: " . $conn->connect_error]));
}
?>
