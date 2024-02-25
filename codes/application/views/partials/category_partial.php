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
                                <span><?= $total_count ?></span><img src="/assets/images/categories/all_products.png"><h4>All Products</h4>
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
                                <span><?= $category['product_count'] ?></span><img src="/assets/images/categories/<?= $category['category_image'] ?>"><h4><?= $category['category_name'] ?></h4>
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
    for($i=10*($page-1); $i<10*$page; $i++){
        if(!empty($products[$i])){
            $images = json_decode($products[$i]['product_image_json'] , true);
?>
                    <li>
                        <a href="/products/show/<?= $products[$i]['product_id'] ?>">
                            <img src="/assets/images/products/<?= $images['image_1'] ?>">
                            <h3><?= $products[$i]['product_name'] ?></h3>
                            <ul class="rating">
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <span>100 Rating</span>
                            <span class="price">$ <?= $products[$i]['product_price'] ?></span>
                        </a>
                    </li>
<?php
        }
    }
?>
                </ul>
            </div>
            <div class="pagination">
<?php
    for($i=0; $i<count($products)/10; $i++){
?>
                <form action="/products/category_partial" class="pagination_form" method="post">
                    <input type="hidden" name="page" value="<?= $i+1 ?>">
                    <input type="hidden" name="category" value="<?= $current_category ?>">
                    <input type="hidden" name="search" value="<?= $search ?>">
                    <input type="submit" value="<?= $i+1 ?>">
                </form>
<?php
    }
?>
            </div>