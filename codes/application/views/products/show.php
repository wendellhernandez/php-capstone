<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Products</title>
        
        <link rel="shortcut icon" href="/assets/images/organic_shop_fav.ico" type="image/x-icon">

        <script src="/assets/js/vendor/jquery.min.js"></script>
        <script src="/assets/js/vendor/popper.min.js"></script>
        <script src="/assets/js/vendor/bootstrap.min.js"></script>
        <script src="/assets/js/vendor/bootstrap-select.min.js"></script>
        <link rel="stylesheet" href="/assets/css/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/css/vendor/bootstrap-select.min.css">

        <script src="/assets/js/global/show.js"></script>
        <link rel="stylesheet" href="/assets/css/custom/global.css">
        <link rel="stylesheet" href="/assets/css/custom/product_view.css">
    </head>
    <body>
        <div class="wrapper">
<?php
    $this->load->view('partials/header');
?>
            <section >
                <form action="/products" method="post" class="search_form">
                    <input type="text" name="search" placeholder="Search Products">
                </form>
<?php
    if($is_logged_in){
?>
                <a class="show_cart" href="/carts">Cart (<?= count($cart_products) ?>)</a>
<?php
    }
?>
                <a href="/products">Go Back</a>
                <ul>
                    <li>
                        <img src="/assets/images/burger.png" alt="food">
                        <ul>
                            <li class="active"><button class="show_image"><img src="/assets/images/burger.png" alt="food"></button></li>
                            <li><button class="show_image"><img src="/assets/images/burger.png" alt="food"></button></li>
                            <li><button class="show_image"><img src="/assets/images/burger.png" alt="food"></button></li>
                            <li><button class="show_image"><img src="/assets/images/burger.png" alt="food"></button></li>
                        </ul>
                    </li>
                    <li>
                        <h2><?= $product['name'] ?></h2>
                        <ul class="rating">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <span>36 Rating</span>
                        <span class="amount">$ <?= $product['price'] ?></span>
                        <p><?= $product['description'] ?></p>
                        <form action="/carts/add_to_cart/<?= $product['id'] ?>" method="post" id="add_to_cart_form">
                            <ul>
                                <li>
                                    <label>Quantity</label>
                                    <input type="text" min-value="1" value="1" id="quantity" name="quantity">
                                    <ul>
                                        <li><button type="button" class="increase_decrease_quantity" data-quantity-ctrl="1"></button></li>
                                        <li><button type="button" class="increase_decrease_quantity" data-quantity-ctrl="0"></button></li>
                                    </ul>
                                </li>
                                <li>
                                    <label>Total Amount</label>
                                    <span class="total_amount">$ <?= $product['price'] ?></span>
                                </li>
<?php
    if($is_logged_in){
?>
                                <li><button type="submit" id="add_to_cart">Add to Cart</button></li>
<?php
    }
?>
                            </ul>
                        </form>
                    </li>
                </ul>
                <section>
                    <h3>Similar Items</h3>
                    <ul>
<?php
    foreach($similar_products as $similar){
?>
                        <li>
                            <a href="/products/show/<?= $similar['id'] ?>">
                                <img src="/assets/images/food.png" alt="#">
                                <h3><?= $similar['name'] ?></h3>
                                <ul class="rating">
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </ul>
                                <span>36 Rating</span>
                                <span class="price">$ <?= $similar['price'] ?></span>
                            </a>
                        </li>
<?php
    }
?>
                    </ul>
                </section>
            </section>
        </div>
    </body>
</html>