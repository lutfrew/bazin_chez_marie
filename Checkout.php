<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Invio email al cliente
    $to_customer = $email;
    $subject_customer = 'Votre commande  Bazin chez Marie';
    $message_customer = "Merci pour votre commande!\n\n";
    foreach ($_SESSION['cart'] as $item) {
        $message_customer .= $item['name'] . " - " . $item['price'] . "€\n";
    }
    $message_customer .= "\nTotal: " . array_sum(array_column($_SESSION['cart'], 'price')) . "€\n\n";
    $message_customer .= "Informations de livraison:\n";
    $message_customer .= "Nom: $name\n";
    $message_customer .= "Prénom: $surname\n";
    $message_customer .= "Adresse: $address\n";
    $message_customer .= "Email: $email\n";
    $message_customer .= "Téléphone: $phone\n";

    mail($to_customer, $subject_customer, $message_customer);

    // Invio email a Marie
    $to_marie = 'bazinchezmarie@gmail.com';
    $subject_marie = 'Nouvelle commande reçue';
    $message_marie = "Nouvelle commande reçue!\n\n";
    foreach ($_SESSION['cart'] as $item) {
        $message_marie .= $item['name'] . " - " . $item['price'] . "€\n";
    }
    $message_marie .= "\nTotal: " . array_sum(array_column($_SESSION['cart'], 'price')) . "€\n\n";
    $message_marie .= "Informations de livraison:\n";
    $message_marie .= "Nom: $name\n";
    $message_marie .= "Prénom: $surname\n";
    $message_marie .= "Adresse: $address\n";
    $message_marie .= "Email: $email\n";
    $message_marie .= "Téléphone: $phone\n";

    mail($to_marie, $subject_marie, $message_marie);

    // Pulizia carrello
    unset($_SESSION['cart']);

    // Affichage du message et redirection
    echo "<script>alert('Commande envoyée!');</script>";
    echo "<script>window.location.href = 'index.html';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            width: 80%;
            max-width: 1200px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .order-summary, .delivery-info {
            width: 48%;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .order-summary {
            padding-right: 20px;
            border-right: 1px solid #ddd;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        p {
            font-size: 16px;
            color: #666;
            text-align: center;
        }
        .total {
            font-weight: bold;
            color: #000;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            max-width: 400px;
            width: 100%;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #666;
        }
        input[type="text"],
        input[type="email"],
        input[type="tel"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        button {
            background-color: #ff6600;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        button:hover {
            background-color: #eb1ae4;
        }
        /* Nouveau bouton "Retour en arrière" */
        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Bouton "Retour en arrière" -->
    <button class="back-button" onclick="history.back()">Retour en arrière</button>

    <div class="container">
        <div class="order-summary">
            <h2>Récapitulatif de la commande</h2>
            <?php if (!empty($_SESSION['cart'])): ?>
                <ul>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <li><?php echo $item['name']; ?> - <?php echo $item['price']; ?>CFA</li>
                    <?php endforeach; ?>
                </ul>
                <p class="total">Total: <?php echo array_sum(array_column($_SESSION['cart'], 'price')); ?>€</p>
            <?php else: ?>
                <p>Le panier est vide.</p>
            <?php endif; ?>
        </div>
        <div class="delivery-info">
            <h2>Informations de livraison</h2>
            <form method="post">
                <label for="name">Nom:</label>
                <input type="text" id="name" name="name" required><br>
                <label for="surname">Prénom:</label>
                <input type="text" id="surname" name="surname" required><br>
                <label for="address">Adresse:</label>
                <input type="text" id="address" name="address" required><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br>
                <label for="phone">Téléphone:</label>
                <input type="tel" id="phone" name="phone" required><br>
                <button type="submit" name="checkout">Envoyer</button>
            </form>
        </div>
    </div>
</body>
</html>
