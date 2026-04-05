<?php
session_start();
include "db.php";

if(!isset($_SESSION['username']) || $_SESSION['role'] != "admin"){
header("Location: login.php");
exit();
}

$result = $conn->query("SELECT * FROM users");

$total_users = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$blocked_users = $conn->query("SELECT COUNT(*) as total FROM users WHERE blocked=1")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html>

<head>

<title>Admin Dashboard</title>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

body{
font-family:'Segoe UI';
background:linear-gradient(135deg,#4facfe,#00f2fe);
margin:0;
padding:40px;
}

.container{
max-width:1100px;
margin:auto;
}

.title{
color:white;
font-size:34px;
margin-bottom:20px;
}

.cards{
display:grid;
grid-template-columns:repeat(3,1fr);
gap:20px;
margin-bottom:30px;
}

.card{
background:white;
padding:25px;
border-radius:15px;
text-align:center;
box-shadow:0 10px 20px rgba(0,0,0,0.2);
}

.card h2{
margin:10px 0;
}

table{
width:100%;
border-collapse:collapse;
background:white;
border-radius:15px;
overflow:hidden;
box-shadow:0 10px 20px rgba(0,0,0,0.2);
}

th{
background:#2f7de1;
color:white;
padding:12px;
}

td{
padding:12px;
text-align:center;
border-bottom:1px solid #eee;
}

.unlock{
background:#4CAF50;
color:white;
padding:6px 12px;
border-radius:20px;
text-decoration:none;
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

.chart{
margin-top:30px;
background:white;
padding:20px;
border-radius:15px;
box-shadow:0 10px 20px rgba(0,0,0,0.2);
}

</style>

</head>

<body>

<div class="container">

<div class="title">
Admin Dashboard
</div>

<div class="cards">

<div class="card">
<span class="material-icons">people</span>
<h3>Total Users</h3>
<h2><?php echo $total_users; ?></h2>
</div>

<div class="card">
<span class="material-icons">block</span>
<h3>Blocked Users</h3>
<h2><?php echo $blocked_users; ?></h2>
</div>

<div class="card">
<span class="material-icons">security</span>
<h3>System Status</h3>
<h2>Secure</h2>
</div>

</div>

<table>

<tr>
<th>ID</th>
<th>Username</th>
<th>Email</th>
<th>Failed Attempts</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php while($row = $result->fetch_assoc()){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['username']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['failed_attempts']; ?></td>

<td>

<?php
if($row['blocked']==1){
echo "<span style='color:red;font-weight:bold;'>Blocked</span>";
}else{
echo "<span style='color:green;'>Active</span>";
}
?>

</td>

<td>

<?php
if($row['blocked']==1){
?>

<a class="unlock" href="unlock.php?id=<?php echo $row['id']; ?>">
Unlock
</a>

<?php
}else{
echo "-";
}
?>

</td>

</tr>

<?php } ?>

</table>

<div class="chart">

<canvas id="chart"></canvas>

</div>

<br>

<a class="logout" href="logout.php">
Logout
</a>

</div>

<script>

const ctx = document.getElementById('chart');

new Chart(ctx, {
type: 'bar',
data: {
labels: ['Users','Blocked'],
datasets: [{
label: 'System Statistics',
data: [<?php echo $total_users; ?>,<?php echo $blocked_users; ?>],
borderWidth: 2
}]
}
});

</script>

</body>
</html>