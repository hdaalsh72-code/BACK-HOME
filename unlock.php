<<?php
include "db.php";

$id = $_GET['id'];

$conn->query("UPDATE users SET blocked=0, failed_attempts=0 WHERE id=$id");

header("Location: admin_dashboard.php");
?>