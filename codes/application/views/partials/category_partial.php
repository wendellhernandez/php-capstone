            <form action="/products/category_partial" method="post" class="search_form">
                <input type="hidden" name="category" value="<?= $current_category ?>">
                <input type="text" name="search" placeholder="Search Products" value="<?= $search ?>">
            </form>
<?php
    if($is_logged_in){
?>
            <a class="show_cart" href="/carts">Cart (<?= count($cart_products) ?>)</a>
<?php
    }
?>
            <form class="categories_form">
                <h3>Categories</h3>
                <ul>
                    <form></form>
                    <li>
                        <form action="/products/category_partial" method="post" class="category_form">
                            <input type="hidden" name="category" value="">
                            <input type="hidden" name="search" value="<?= $search ?>">
                            <button type="submit">
                                <span><?= $total_count ?></span><img src="/assets/images/apple.png"><h4>All Products</h4>
                            </button>
                        </form>
                    </li>
<?php
    foreach($categories as $category){
?>
                    <li>
                        <form action="/products/category_partial" method="post" class="category_form">
                            <input type="hidden" name="category" value="<?= $category['category_name'] ?>">
                            <input type="hidden" name="search" value="<?= $search ?>">
                            <button type="submit">
                                <span><?= $category['product_count'] ?></span><img src="/assets/images/apple.png"><h4><?= $category['category_name'] ?></h4>
                            </button>
                        </form>
                    </li>
<?php
    }
?>
                </ul>
            </form>
            <div>
                <h3><?= !empty($current_category) ? $current_category : 'All Products' ?>(<?= count($products) ?>)</h3>
                <ul>
<?php
    foreach($products as $product){
?>
                    <li>
                        <a href="/products/show/<?= $product['product_id'] ?>">
                            <img src="/assets/images/food.png" alt="#">
                            <h3><?= $product['product_name'] ?></h3>
                            <ul class="rating">
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <span>100 Rating</span>
                            <span class="price">$ <?= $product['product_price'] ?></span>
                        </a>
                    </li>
<?php
    }
?>
                </ul>
            </div>