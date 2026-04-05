<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

$heartRate = rand(60,110);

$status = "Stable";
if($heartRate > 100){
    $status = "Warning";
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Patient Dashboard</title>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

body{
font-family:'Segoe UI';
background:linear-gradient(135deg,#4facfe,#00f2fe);
margin:0;
padding:40px;
transition:0.4s;
}

.dark{
background:#121212;
color:white;
}

.container{
max-width:900px;
margin:auto;
}

.title{
color:white;
font-size:34px;
margin-bottom:15px;
}

.status{
background:white;
padding:20px;
border-radius:15px;
margin-bottom:25px;
box-shadow:0 10px 20px rgba(0,0,0,0.2);
font-size:20px;
}

.cards{
display:grid;
grid-template-columns:repeat(2,1fr);
gap:20px;
}

.card{
background:white;
padding:25px;
border-radius:15px;
text-align:center;
box-shadow:0 10px 20px rgba(0,0,0,0.2);
transition:0.3s;
}

.card:hover{
transform:scale(1.07);
}

.material-icons{
font-size:45px;
color:#2f7de1;
margin-bottom:10px;
}

.value{
font-size:22px;
font-weight:bold;
}

.chart{
margin-top:30px;
background:white;
padding:20px;
border-radius:15px;
box-shadow:0 10px 20px rgba(0,0,0,0.2);
}

.map{
margin-top:25px;
background:white;
padding:10px;
border-radius:15px;
box-shadow:0 10px 20px rgba(0,0,0,0.2);
}

iframe{
width:100%;
height:250px;
border-radius:10px;
border:none;
}

button{
margin-top:25px;
padding:12px 35px;
border:none;
border-radius:30px;
background:#2f7de1;
color:white;
font-size:16px;
cursor:pointer;
}

.toggle{
background:black;
margin-left:10px;
}

.logout{
margin-top:20px;
display:inline-block;
background:#ff4d4d;
padding:10px 20px;
border-radius:25px;
color:white;
text-decoration:none;
}

</style>

</head>

<body id="body">

<div class="container">

<div class="title">
Back Home Dashboard
<button class="toggle" onclick="darkMode()">🌙</button>
</div>

<div class="status">
Patient Status: <?php echo $status; ?>
</div>

<div class="cards">

<div class="card">
<span class="material-icons">favorite</span>
<div>Heart Rate</div>
<div class="value"><?php echo $heartRate; ?> bpm</div>
</div>

<div class="card">
<span class="material-icons">watch</span>
<div>Watch Status</div>
<div class="value">Connected</div>
</div>

<div class="card">
<span class="material-icons">warning</span>
<div>Alerts</div>
<div class="value">
<?php
if($heartRate > 100){
    echo "High Heart Rate!";
}else{
    echo "No Alerts";
}
?>
</div>
</div>

<div class="card">
<span class="material-icons">security</span>
<div>Encryption</div>
<div class="value">Enabled</div>
</div>

</div>

<div class="chart">

<canvas id="heartChart"></canvas>

</div>

<div class="map">

<iframe src="https://maps.google.com/maps?q=muscat&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>

</div>

<center>

<button onclick="window.location='encrypt.php'">
Encryption Tool
</button>

<br><br>

<a class="logout" href="logout.php">
Logout
</a>

</center>

</div>

<script>

function darkMode(){
document.getElementById("body").classList.toggle("dark");
}

const ctx = document.getElementById('heartChart');

new Chart(ctx, {
type: 'line',
data: {
labels: ['1','2','3','4','5','6'],
datasets: [{
label: 'Heart Rate',
data: [72,75,80,78,76,<?php echo $heartRate; ?>],
borderWidth: 3
}]
},
options: {
scales: {
y: {
beginAtZero: false
}
}
}
});

<script>

var heartRate = <?php echo $heartRate; ?>;

if(heartRate > 100){
alert("⚠ Warning: High Heart Rate Detected!");
}


</script>

</body>
</html>