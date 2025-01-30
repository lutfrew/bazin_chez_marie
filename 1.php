<?php
// Funzione per registrare i clic in un file di testo
function logClick() {
    $file = 'clics.txt';
    $date_heure = date('Y-m-d H:i:s');
    $ip_address = $_SERVER['REMOTE_ADDR']; // Aggiungi l'IP dell'utente
    $entry = $date_heure . " | " . $ip_address . "\n";

    file_put_contents($file, $entry, FILE_APPEND | LOCK_EX);
}

// Inserisci un nuovo clic nel file di testo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    logClick();

    // Reindirizzamento al sito principale
    header("Location: https://www.sitodocenza.it/public/MyBox/user/V76tbWJR49ozOX7_fallu/file/Spaw-Starter/index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>BAZIN CHEZ MARIE 🛒</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        button {
            background-color: violet;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: darkmagenta;
        }
    </style>
</head>
<body>
    <form method="post">
        <button type="submit">BAZIN CHEZ MARIE 🛒</button>
    </form>
</body>
</html>
