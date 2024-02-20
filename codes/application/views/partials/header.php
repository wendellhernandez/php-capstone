            <header>
                <h1>Let's order fresh items for you.</h1>
                <div>
<?php
    if($is_logged_in){
?>
                    <a class="profile_btn" href="/users/profile">Welcome! <?= $first_name ?></a>
                    <a class="login_btn" href="/users/logout">Logout</a>
<?php
    }else{
?>
                    <a class="signup_btn" href="/signup">Signup</a>
                    <a class="login_btn" href="/login">Login</a>
<?php
    }
?>
                </div>
            </header>
            <aside>
                <a href="/products"><img src="/assets/images/organic_shop_logo.svg" alt="Organic Shop"></a>
            </aside>