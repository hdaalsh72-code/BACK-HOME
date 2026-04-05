<?php
session_start();
$_SESSION['username'] = "Guest";
$_SESSION['role'] = "guest";
?>

<!DOCTYPE html>
<html>

<head>
<title>Guest Page</title>
</head>

<body style="text-align:center; margin-top:100px; font-family:Segoe UI;">

<h1>Welcome Guest 👋</h1>
<p>You are browsing as guest (limited access)</p>

<a href="login.php">Back to Login</a>

</body>
</html>