<?php include 'db.php'; ?>
<?php
$id = $_GET['id'];
$artist = $conn->query("SELECT * FROM commissioned_artists WHERE ID=$id")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Artist Details - <?= $artist['NAME'] ?></title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Poppins', sans-serif;
         background: linear-gradient(to right, #9cf1fcff, #ee9bffff);
        margin: 0;
        padding: 0;
        color: #2C2C2C;
    }

    .container {
        max-width: 700px;
        margin: 60px auto;
        background: #ffffff;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        text-align: center;
    }

    h1 {
        color: #74B49B;
        font-weight: 600;
        margin-bottom: 10px;
    }

    h3 {
        color: #E9AFA3;
        margin-top: 0;
    }

    .info {
        margin: 25px 0;
        font-size: 18px;
    }

    .card {
        background: #f8ede3;
        border-radius: 15px;
        padding: 20px;
        margin-top: 20px;
    }

    a {
        display: inline-block;
        text-decoration: none;
        background: #74B49B;
        color: white;
        padding: 10px 20px;
        border-radius: 10px;
        transition: 0.3s;
    }

    a:hover {
        background: #5e9c83;
    }

    .earn {
        font-size: 24px;
        color: #2C2C2C;
        margin-top: 15px;
    }
</style>
</head>
<body>

<div class="container">
    <h1><?= $artist['NAME'] ?></h1>
    <h3><?= $artist['TYPE_OF_ARTS'] ?></h3>

    <div class="card">
        <div class="info">Number of Clients: <strong><?= $artist['CLIENT_AMOUNT'] ?></strong></div>
        <div class="earn">Total Earnings: <strong>$<?= number_format($artist['TOTAL_EARNINGS'], 2) ?></strong></div>
    </div>

    <br><br>
    <a href="index.php">← Back to List</a>
</div>

</body>
</html>
