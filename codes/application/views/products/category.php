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

        <script src="/assets/js/global/category.js"></script>
        <link rel="stylesheet" href="/assets/css/custom/global.css">
        <link rel="stylesheet" href="/assets/css/custom/product_dashboard.css">
        <link rel="stylesheet" href="/assets/css/custom/category.css">
    </head>
    <body>
        <div class="wrapper">
<?php
    $this->load->view('partials/header');
?>

            <section >
                <form action="/products/category_partial" method="post" class="search_form">
                    <input type="hidden" name="category" value="<?= !empty($category) ? $category : '' ?>">
                    <input type="text" name="search" placeholder="Search Products" value="<?= !empty($search) ? $search : '' ?>">
                </form>
            </section>
        </div>
    </body>
</html>