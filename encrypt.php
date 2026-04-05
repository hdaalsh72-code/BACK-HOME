<?php

$result="";

if(isset($_POST['encrypt'])){
$result = base64_encode($_POST['text']);
}

if(isset($_POST['decrypt'])){
$result = base64_decode($_POST['text']);
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Encryption Tool</title>

<style>

body{
font-family:'Segoe UI';
background:linear-gradient(135deg,#4facfe,#00f2fe);
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

.box{
background:white;
padding:40px;
border-radius:20px;
width:400px;
text-align:center;
box-shadow:0 10px 20px rgba(0,0,0,0.2);
}

textarea{
width:100%;
height:100px;
margin:10px 0;
padding:10px;
border-radius:10px;
border:1px solid #ddd;
}

button{
padding:10px 20px;
margin:5px;
border:none;
border-radius:20px;
cursor:pointer;
}

.encrypt{
background:#2f7de1;
color:white;
}

.decrypt{
background:#4CAF50;
color:white;
}

</style>

</head>

<body>

<div class="box">

<h2>Encryption Tool</h2>

<form method="POST">

<textarea name="text" placeholder="Enter text"></textarea>

<br>

<button class="encrypt" name="encrypt">
Encrypt
</button>

<button class="decrypt" name="decrypt">
Decrypt
</button>

</form>

<p><?php echo $result; ?></p>

<br>

<a href="user_dashboard.php">Back</a>

</div>

</body>
</html>
