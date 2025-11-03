<?php
include 'db.php';
$id = $_GET['id'];
$conn->query("DELETE FROM commissioned_artists WHERE id=$id");
header("Location: index.php");
?>
