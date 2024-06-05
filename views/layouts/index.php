<?php
/** @var string $Title */
/** @var string $Content */

use models\Users;
use core\Cart;

if (empty($Title)) {
    $Title = "";
}
if (empty($Content)) {
    $Content = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?= $Title ?></title>
    <link rel="icon" type="image/png" href="https://www.pngmart.com/files/15/Empty-Glass-Bottle-PNG-File.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script defer src="index.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .navbar-fixed {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background-color: white;
            box-shadow: 0 4px 2px -2px gray;
        }

        body {
            padding-top: 60px;
        }

        .cart-badge {
            position: absolute;
            bottom: -10px;
            right: -10px;
        }
    </style>
</head>
<body>
<div class="navbar navbar-expand-lg navbar-light bg-light navbar-fixed">
    <div class="container-fluid">
        <a href="/" class="navbar-brand">SibashShop</a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a href="/" class="nav-link">Головна</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Customers</a></li>
            <li class="nav-item"><a href="/drinks/index" class="nav-link">Напої</a></li>
            <?php if (Users::IsUserLogged()): ?>
                <?php if (Users::IsUserAdmin()): ?>
                    <li class="nav-item"><a href="/order/index" class="nav-link">Замовлення</a></li>
                <?php endif; ?>
                <li class="nav-item"><a href="/users/logout" class="nav-link">Вийти</a></li>
            <?php else: ?>
                <li class="nav-item"><a href="/users/login" class="nav-link">Увійти</a></li>
                <li class="nav-item"><a href="/users/register" class="nav-link">Зареєструватись</a></li>
            <?php endif; ?>
        </ul>

        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search">
        </form>
        <?php if (Users::IsUserLogged()): ?>
            <div class="dropdown text-end">
                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://image-thumbs.shafastatic.net/313102076_310_430" alt="mdo" width="32" height="32" class="rounded-circle">
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="/users/profile">Профіль</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="/users/logout">Вийти</a></li>
                </ul>
            </div>
        <?php endif; ?>
        <div class="dropdown text-end ms-3 position-relative">
            <a href="/drinks/cart" class="d-block link-dark text-decoration-none position-relative">
                <i class="bi bi-cart-fill" style="font-size: 1.5rem;"></i>
                <?php
                $cartItemsCount = count(Cart::getProducts());
                if ($cartItemsCount > 0): ?>
                    <span class="badge bg-danger rounded-pill cart-badge"><?= $cartItemsCount ?></span>
                <?php endif; ?>
            </a>
        </div>
    </div>
</div>
<div>
    <div class="container">
        <h1><?= $Title ?></h1>
    </div>
    <?= $Content ?>
</div>
<div class="container">
    <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Features</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Pricing</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">FAQs</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About</a></li>
        </ul>
        <p class="text-center text-body-secondary">© 2024 Company, Inc</p>
    </footer>
</div>
</body>
</html>
