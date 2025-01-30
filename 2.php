<?php
// Funzione per registrare i clic in un file di testo
function logClick() {
    $file = 'clics.txt';
    $date_heure = date('Y-m-d H:i:s');
    $entry = $date_heure . "\n";

    file_put_contents($file, $entry, FILE_APPEND | LOCK_EX);
}

// Funzione per leggere i clic dal file di testo
function getClicks() {
    $file = 'clics.txt';
    if (file_exists($file)) {
        $contents = file($file, FILE_IGNORE_NEW_LINES);
        return $contents;
    } else {
        return [];
    }
}

// Registrare un clic se il parametro "click" è presente nell'URL
if (isset($_GET['click'])) {
    logClick();
    // Reindirizzamento al sito principale dopo aver registrato il clic
    header("Location: https://www.sitodocenza.it/public/MyBox/user/V76tbWJR49ozOX7_fallu/file/Spaw-Starter/index.html");
    exit();
}

// Recupera i clic dal file di testo
$clics = getClicks();
$totalClicks = count($clics);
$clicksByDay = [];

foreach ($clics as $clic) {
    $date = substr($clic, 0, 10);
    if (!isset($clicksByDay[$date])) {
        $clicksByDay[$date] = 0;
    }
    $clicksByDay[$date]++;
}

// Converti i dati per Chart.js
$labels = json_encode(array_keys($clicksByDay));
$data = json_encode(array_values($clicksByDay));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Statistiques des Visites</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        .container {
            display: flex;
            justify-content: space-between;
        }
        .table-container, .chart-container {
            width: 48%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: orange;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .stats {
            margin-bottom: 20px;
        }
        .stat-bar {
            background-color: orange;
            height: 20px;
            margin: 5px 0;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Statistiques des Visites</h1>
    <div class="stats">
        <p>Total des clics: <?php echo $totalClicks; ?></p>
    </div>
    <div class="container">
        <div class="table-container">
            <h2>Détails des clics</h2>
            <table>
                <tr>
                    <th>Date et Heure</th>
                </tr>
                <?php
                if ($totalClicks > 0) {
                    foreach ($clics as $clic) {
                        echo "<tr><td>" . $clic . "</td></tr>";
                    }
                } else {
                    echo "<tr><td>0 résultats</td></tr>";
                }
                ?>
            </table>
        </div>
        <div class="chart-container">
            <h2>Graphique des clics par jour</h2>
            <canvas id="clickChart"></canvas>
        </div>
    </div>
    <script>
        var ctx = document.getElementById('clickChart').getContext('2d');
        var clickChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo $labels; ?>,
                datasets: [{
                    label: 'Nombre de clics',
                    data: <?php echo $data; ?>,
                    backgroundColor: 'orange',
                    borderColor: 'darkorange',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
