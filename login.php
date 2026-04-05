<?php
session_start();
include "db.php";

$message = "";

if(isset($_POST['login'])){

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($query);

if($result->num_rows > 0){

$user = $result->fetch_assoc();

$hash = hash("sha256",$password);

if($hash == $user['password_hash']){
$conn->query("UPDATE users SET failed_attempts=0 WHERE id=".$user['id']);

$_SESSION['username'] = $user['username'];
$_SESSION['role'] = $user['role'];

if($user['role']=="admin"){
header("Location: admin_dashboard.php");
}else{
header("Location: user_dashboard.php");
}

}else{

$attempts = $user['failed_attempts'] + 1;

$conn->query("UPDATE users SET failed_attempts=$attempts WHERE id=".$user['id']);

if($attempts == 3){

$admin_email="admin@gmail.com";
$subject="Security Alert";
$msg="User ".$username." entered wrong password 3 times.";

mail($admin_email,$subject,$msg);

$message="Warning sent to admin";

}
else if($attempts >= 4){

$conn->query("UPDATE users SET blocked=1 WHERE id=".$user['id']);

$message="Account blocked. Contact admin.";

}
else{

$message="Wrong password";

}

}


}else{
$message = "User not found";
}

}
?>

<!DOCTYPE html>
<html>

<head>

<title>Back Home Login</title>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<style>

body{
    font-family:'Segoe UI';
    background:linear-gradient(135deg,#4facfe,#00f2fe);
    display:flex;
    justify-content:center;
    align-items:center;
    margin:0;
}

/* card */

.login-box{
background:white;
padding:40px;
border-radius:25px;
width:370px;
text-align:center;
box-shadow:0 15px 35px rgba(0,0,0,0.2);
}

/* title */

.title{
font-size:36px;
font-weight:bold;
color:#333;
}

.subtitle{
color:#777;
font-size:15px;
margin-bottom:25px;
}

/* avatar */

.avatar{
width:180px;
height:180px;
margin:20px auto;
border-radius:50%;
background:linear-gradient(#64B5F6,#2f7de1);
display:flex;
align-items:center;
justify-content:center;
box-shadow:0 10px 20px rgba(0,0,0,0.25);
}

.avatar .material-icons{
font-size:90px;
color:white;
}

/* icons */

.icons{
font-size:24px;
margin:10px 0 20px 0;
}

.icons span{
margin:0 12px;
}

/* message */

.message{
color:red;
font-size:14px;
margin-bottom:10px;
}

/* inputs */

input{
width:100%;
padding:13px;
margin:10px 0;
border-radius:12px;
border:1px solid #ddd;
font-size:14px;
}

input:focus{
outline:none;
border-color:#1976d2;
box-shadow:0 0 8px rgba(25,118,210,0.3);
}

/* button */

button{
width:100%;
padding:13px;
margin-top:10px;
background:#2f7de1;
color:white;
border:none;
border-radius:12px;
font-size:16px;
cursor:pointer;
transition:0.3s;
}

button:hover{
background:#1f63c0;
transform:scale(1.05);
}

/* create account */

.create{
margin-top:15px;
font-size:14px;
color:#666;
}

.create a{
color:#2f7de1;
font-weight:bold;
text-decoration:none;
}

.footer{
margin-top:15px;
font-size:12px;
color:#888;
}

</style>

</head>

<body>

<div class="login-box">

<div class="title">Back Home</div>
<div class="subtitle">Smart Alzheimer Tracking System</div>

<div class="avatar">
<span class="material-icons">elderly</span>
</div>

<div class="icons">
<span>⌚</span>
<span>❤️</span>
<span>📍</span>
</div>

<?php if($message!=""){ ?>
<div class="message"><?php echo $message; ?></div>
<?php } ?>

<form method="POST">

<input type="text" name="username" placeholder="Username" required>

<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="login">Sign In</button>

<button type="button" onclick="window.location='guest.php'">
Continue as Guest
</button>

</form>

<p class="create">
Don't have an account? <a href="register.php">Create Account</a>
</p>

<div class="footer">
Secure Authentication System
</div>

</div>

</body>
</html>