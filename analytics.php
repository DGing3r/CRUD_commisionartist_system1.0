<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Artist Analytics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
             background: linear-gradient(to right, #9cf1fcff, #ee9bffff);
            text-align: center;
            color: #2C2C2C;
        }

        h1 {
            background: linear-gradient(to right, #3cc1d3ff, #ff59cdff);
            color: #fff;
            text-align: center;
            padding: 20px;
            font-size: 24px;
            letter-spacing: 1px;
        }
        .container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        a {
            text-decoration: none;
            color: white;
            background: #f88ebaff;
            padding: 8px 15px;
            border-radius: 10px;
        }
        a:hover { background: #a0ddc5; }

        table {
            border-collapse: collapse;
            width: 90%;
            margin: 20px auto;
        }
        th, td {
            border: 2px solid #b9276b;
            padding: 8px;
            text-align: center;
        }
        th { background-color: #6375fc; color: white; }
        h3, h4 { margin-top: 20px; }
    </style>
</head>
<body>
<div class="container">
    <h1>🎨 Artist Insights</h1>
    <a href="index.php">Back to List</a><br><br>

    <?php
    // Subqueries and datasets
    $top = $conn->query("SELECT NAME, TOTAL_EARNINGS FROM commissioned_artists 
                         WHERE TOTAL_EARNINGS = (SELECT MAX(TOTAL_EARNINGS) FROM commissioned_artists)")
                         ->fetch_assoc();

    $avg = $conn->query("SELECT AVG(TOTAL_EARNINGS) AS avg_earn FROM commissioned_artists")
                ->fetch_assoc();

    $above = $conn->query("SELECT * FROM commissioned_artists 
                           WHERE TOTAL_EARNINGS > (SELECT AVG(TOTAL_EARNINGS) FROM commissioned_artists)");

    $below = $conn->query("SELECT * FROM commissioned_artists 
                           WHERE TOTAL_EARNINGS < (SELECT AVG(TOTAL_EARNINGS) FROM commissioned_artists)");

    // Chart data
    $data = $conn->query("SELECT NAME, TOTAL_EARNINGS FROM commissioned_artists");
    $names = [];
    $earnings = [];
    while($row = $data->fetch_assoc()) {
        $names[] = $row['NAME'];
        $earnings[] = $row['TOTAL_EARNINGS'];
    }
    ?>

    <h3>Top Earning Artist: <?= $top['NAME'] ?> ($<?= $top['TOTAL_EARNINGS'] ?>)</h3>
    <h4>Average Earnings: $<?= number_format($avg['avg_earn'], 2) ?></h4>

    <h3>Artists Above Average Earnings</h3>
    <table>
        <tr><th>Name</th><th>Art Type</th><th>Clients</th><th>Earnings</th></tr>
        <?php while($row = $above->fetch_assoc()): ?>
        <tr>
            <td><?= $row['NAME'] ?></td>
            <td><?= $row['TYPE_OF_ARTS'] ?></td>
            <td><?= $row['CLIENT_AMOUNT'] ?></td>
            <td><?= $row['TOTAL_EARNINGS'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h3>Artists Below Average Earnings</h3>
    <table>
        <tr><th>Name</th><th>Art Type</th><th>Clients</th><th>Earnings</th></tr>
        <?php while($row = $below->fetch_assoc()): ?>
        <tr>
            <td><?= $row['NAME'] ?></td>
            <td><?= $row['TYPE_OF_ARTS'] ?></td>
            <td><?= $row['CLIENT_AMOUNT'] ?></td>
            <td><?= $row['TOTAL_EARNINGS'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h3>Earnings Visualization</h3>
    <canvas id="earnChart" width="600" height="300"></canvas>

    <script>
        const ctx = document.getElementById('earnChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($names) ?>,
                datasets: [{
                    label: 'Earnings ($)',
                    data: <?= json_encode($earnings) ?>,
                    backgroundColor: ['#E9AFA3','#74B49B','#F9CE8F','#B692C2','#8EC3B0'],
                    borderRadius: 8
                }]
            },
            options: {
                scales: { y: { beginAtZero: true } },
                plugins: {
                    legend: { display: false },
                    title: { display: true, text: 'Earnings per Artist', font: { size: 18 } }
                }
            }
        });
    </script>
</div>
</body>
</html>
