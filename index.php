<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>Back Home</title>

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
overflow:hidden;
}

/* loading screen */

#loader{
position:fixed;
width:100%;
height:100%;
background:white;
display:flex;
justify-content:center;
align-items:center;
z-index:999;
}

.spinner{
width:60px;
height:60px;
border:6px solid #ddd;
border-top:6px solid #2f7de1;
border-radius:50%;
animation:spin 1s linear infinite;
}

@keyframes spin{
0%{transform:rotate(0deg);}
100%{transform:rotate(360deg);}
}

/* main card */

.card{
background:white;
padding:50px;
border-radius:25px;
width:380px;
text-align:center;
box-shadow:0 15px 35px rgba(0,0,0,0.2);
animation:fade 0.8s ease;
}

@keyframes fade{
from{
opacity:0;
transform:translateY(-20px);
}
to{
opacity:1;
transform:translateY(0);
}
}

.title{
font-size:40px;
font-weight:bold;
color:#333;
}

.subtitle{
color:#777;
margin-bottom:30px;
}

/* avatar */

.avatar{
width:200px;
height:200px;
margin:25px auto;
border-radius:50%;
background:linear-gradient(#64B5F6,#2f7de1);
display:flex;
align-items:center;
justify-content:center;
box-shadow:0 10px 25px rgba(0,0,0,0.25);
}

.avatar .material-icons{
font-size:100px;
color:white;
}

/* icons */

.icons{
font-size:26px;
margin:20px 0;
}

.icons span{
margin:0 15px;
}

/* button */

button{
margin-top:20px;
padding:14px 40px;
background:#2f7de1;
color:white;
border:none;
border-radius:30px;
font-size:18px;
cursor:pointer;
transition:0.3s;
}

button:hover{
background:#1f63c0;
transform:scale(1.05);
}

</style>

</head>

<body>

<div id="loader">
<div class="spinner"></div>
</div>

<div class="card">

<div class="title">Back Home</div>

<div class="subtitle">
Smart Alzheimer Tracking System
</div>

<div class="avatar">
<span class="material-icons">elderly</span>
</div>

<div class="icons">
<span>⌚</span>
<span>❤️</span>
<span>📍</span>
</div>

<button onclick="window.location='login.php'">
Get Started
</button>

</div>

<script>

window.onload = function(){

setTimeout(function(){
document.getElementById("loader").style.display="none";
},700);

}

</script>

</body>
</html>