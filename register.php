<?php
include "db.php";

$message="";

if(isset($_POST['register'])){

$username=$_POST['username'];
$email=$_POST['email'];
$password=$_POST['password'];

$hash=hash("sha256",$password);

$sql="INSERT INTO users (username,email,password_hash,role)
VALUES ('$username','$email','$hash','user')";

if($conn->query($sql)){
$message="Account created successfully";
}else{
$message="Error creating account";
}

}
?>

<!DOCTYPE html>
<html>

<head>

<title>Create Account</title>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<style>

body{
font-family:'Segoe UI';
background:linear-gradient(135deg,#4facfe,#00f2fe);
display:flex;
justify-content:center;
align-items:center;
height:100vh;
margin:0;
}

.card{
background:white;
padding:40px;
border-radius:25px;
width:370px;
text-align:center;
box-shadow:0 15px 35px rgba(0,0,0,0.2);
}

.title{
font-size:32px;
font-weight:bold;
color:#333;
}

.avatar{
width:150px;
height:150px;
margin:20px auto;
border-radius:50%;
background:linear-gradient(#64B5F6,#2f7de1);
display:flex;
align-items:center;
justify-content:center;
}

.avatar .material-icons{
font-size:80px;
color:white;
}

input{
width:100%;
padding:12px;
margin:10px 0;
border-radius:12px;
border:1px solid #ddd;
}

button{
width:100%;
padding:12px;
margin-top:10px;
background:#2f7de1;
color:white;
border:none;
border-radius:12px;
font-size:16px;
cursor:pointer;
}

button:hover{
background:#1f63c0;
}

.message{
color:green;
margin-top:10px;
}

.login{
margin-top:15px;
font-size:14px;
}

.login a{
color:#2f7de1;
font-weight:bold;
text-decoration:none;
}

</style>

</head>

<body>

<div class="card">

<div class="title">Create Account</div>

<div class="avatar">
<span class="material-icons">person_add</span>
</div>

<form method="POST">

<input type="text" name="username" placeholder="Username" required>

<input type="email" name="email" placeholder="Email Address" required>

<input type="password" name="password" placeholder="Password" required>

<button name="register">Sign Up</button>

</form>

<?php if($message!=""){ ?>
<div class="message"><?php echo $message; ?></div>
<?php } ?>

<div class="login">
Already have an account?
<a href="login.php">Sign In</a>
</div>

</div>

</body>
</html>