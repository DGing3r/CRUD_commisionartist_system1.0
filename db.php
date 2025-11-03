<?php
$host = "sql305.infinityfree.com";
$user = "if0_40326605";
$pass = "VhRpxg71uBn13";
$db = "if0_40326605_artsyartsy";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
