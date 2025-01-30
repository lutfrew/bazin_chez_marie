<center>
<!-- HTML !-->
<button class="button-51" role="button" ><a href="index.html">HOME </a></button>
<style>
/* CSS */
.button-51 {
  background-color: transparent;
  border: 1px solid #266DB6;
  box-sizing: border-box;
  color: #0013CC;
  font-family: "Avenir Next LT W01 Bold",sans-serif;
  font-size: 16px;
  font-weight: 700;
  line-height: 24px;
  padding: 16px 23px;
  position: relative;
  text-decoration: none;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}

.button-51:hover,
.button-51:active {
  outline: 0;
}

.button-51:hover {
  background-color: transparent;
  cursor: pointer;
}

.button-51:before {
  background-color: #D5EDF6;
  content: "";
  height: calc(100% + 3px);
  position: absolute;
  right: -7px;
  top: -9px;
  transition: background-color 300ms ease-in;
  width: 100%;
  z-index: -1;
}

.button-51:hover:before {
  background-color: #6DCFF6;
}

@media (min-width: 768px) {
  .button-51 {
    padding: 16px 32px;
  }
}
</style>

</center>

<?php
session_start();

// Sample product data with images
$products = [
    ['name' => 'Bazin', 'price' => 5000, 'image' => '1.jpg'],


    ['name' => 'Voile Habiba', 'price' => 5000, 'image' => '2.jpg'],


    ['name' => 'Gellaba', 'price' => 40, 'image' => '3.jpg'],


    ['name' => 'Gellaba', 'price' => 40, 'image' => '4.jpg'],


    ['name' => 'Gellaba', 'price' => 40, 'image' => '5.jpg'],


    ['name' => 'Gellaba', 'price' => 40, 'image' => '6.jpg'],


    ['name' => 'Gellaba', 'price' => 40, 'image' => '7.jpg'],


    ['name' => 'Gellaba', 'price' => 40, 'image' => '8.jpg'],


    ['name' => 'Gellaba', 'price' => 40, 'image' => '9.jpg'],


    ['name' => 'Gellaba', 'price' => 40, 'image' => '10.jpg'],


    ['name' => 'Gellaba', 'price' => 40, 'image' => '11.jpg'],


    ['name' => 'Gellaba', 'price' => 40, 'image' => '12.jpg'],


    ['name' => 'Gellaba', 'price' => 40, 'image' => '13.jpg'],


    ['name' => 'Gellaba', 'price' => 40, 'image' => '14.jpg'],


    ['name' => 'Gellaba', 'price' => 40, 'image' => '15.jpg'],


    ['name' => 'Gellaba', 'price' => 40, 'image' => '16.jpg'],


    ['name' => 'Gellaba', 'price' => 40, 'image' => '17.jpg'],


    ['name' => 'Gellaba', 'price' => 40, 'image' => '18.jpg'],


    ['name' => 'Gellaba', 'price' => 40, 'image' => '19.jpg'],


    ['name' => 'Gellaba', 'price' => 40, 'image' => '20.jpg'],


    ['name' => 'Gellaba', 'price' => 40, 'image' => '21.jpg'],


    ['name' => 'Gellaba', 'price' => 40, 'image' => '22.jpg'],


    ['name' => 'Gellaba', 'price' => 40, 'image' => '23.jpg'],


    ['name' => 'Gellaba', 'price' => 40, 'image' => '24.jpg'],


    ['name' => 'Gellaba', 'price' => 40, 'image' => '25.jpg'],


    ['name' => 'Gellaba', 'price' => 40, 'image' => '26.jpg'],


    // Add more products as needed
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_to_cart'])) {
        $product = $products[$_POST['product_id']];
        $_SESSION['cart'][] = $product;
    }
    if (isset($_POST['remove_from_cart'])) {
        $index = $_POST['index'];
        array_splice($_SESSION['cart'], $index, 1);
    }
}

// Count the number of items in the cart
$cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Produits</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f8f9fa;
        }
        .products {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            padding: 20px;
        }
        .product {
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .product:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }
        .product img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            transition: transform 0.3s;
        }
        .product img:hover {
            transform: scale(1.1);
        }
        .cart-icon {
            position: fixed;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
        .cart-icon img {
            width: 50px;
            height: 50px;
        }
        .cart-icon .cart-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background: red;
            color: white;
            border-radius: 50%;
            padding: 5px 10px;
            font-size: 12px;
        }
        .cart-modal {
            display: none;
            position: fixed;
            top: 0;
            right: 0;
            width: 300px;
            height: 100%;
            background: white;
            border-left: 1px solid #ccc;
            padding: 20px;
            box-shadow: -2px 0 5px rgba(0,0,0,0.5);
            z-index: 1000;
            overflow-y: auto;
        }
        .cart-modal ul {
            list-style-type: none;
            padding: 0;
        }
        .cart-modal li {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }
        .cart-modal li img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
            border-radius: 5px;
        }
        .cart-modal h2, .cart-modal p {
            margin: 0 0 10px 0;
        }
        .close-cart {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
        .remove-item {
            margin-left: auto;
            cursor: pointer;
            color: red;
            font-weight: bold;
            border: none;
            background: none;
        }
        @media (max-width: 1200px) {
            .products {
                grid-template-columns: repeat(4, 1fr);
            }
        }
        @media (max-width: 992px) {
            .products {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        @media (max-width: 768px) {
            .products {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 480px) {
            .products {
                grid-template-columns: 1fr;
            }
            .cart-modal {
                width: 100%;
            }
        }
    </style>
    <script>
        function toggleCartModal() {
            var modal = document.getElementById('cartModal');
            if (modal.style.display === 'none' || modal.style.display === '') {
                modal.style.display = 'block';
            } else {
                modal.style.display = 'none';
            }
        }
    </script>
</head>
<body>
    <div class="products">
        <?php foreach ($products as $index => $product): ?>
            <div class="product">
                <h2><?php echo $product['name']; ?></h2>
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                <p><?php echo $product['price']; ?>CFA</p>
                <form method="post">
                    <input type="hidden" name="product_id" value="<?php echo $index; ?>">
                    <button type="submit" name="add_to_cart">Ajouter au panier</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="cart-icon" onclick="toggleCartModal()">
        <img src="cart.png" alt="Cart Icon">
        <?php if ($cart_count > 0): ?>
            <div class="cart-count"><?php echo $cart_count; ?></div>
        <?php endif; ?>
    </div>
    <div id="cartModal" class="cart-modal">
        <span class="close-cart" onclick="toggleCartModal()">✖</span>
        <h2>Panier</h2>
        <?php if (!empty($_SESSION['cart'])): ?>
            <ul>
                <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                    <li>
                        <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                        <?php echo $item['name']; ?> - <?php echo $item['price']; ?>CFA
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                            <button type="submit" name="remove_from_cart" class="remove-item">✖</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
            <p>Total: <?php echo array_sum(array_column($_SESSION['cart'], 'price')); ?>CFA</p>
            <a href="checkout.php">Acheter</a>
        <?php else: ?>
            <p>Le panier est vide.</p>
        <?php endif; ?>
    </div>
</body>
</html>
<center>
<p class="copy-footer-29 text-center">BAZIN CHEZ MARIE&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>TEL:77 544 99 21</b></p>
</center>