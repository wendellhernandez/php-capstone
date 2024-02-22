            <header>
                <h1>Let's provide fresh items for everyone.</h1>
                <h2><?= $aside_header_title ?></h2>
                <div>
                    <a class="switch" href="/products">Switch to Shop View</a>
                    <button href="/users/profile" class="profile">
                        <a href="/users/profile">Welcome! <?= $first_name ?></a>
                    </button>
                </div>
                <div class="dropdown show">
                    <a class="btn btn-secondary dropdown-toggle profile_dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                    <div class="dropdown-menu admin_dropdown" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="/users/logout">Logout</a>
                    </div>
                </div>
            </header>
            <aside>
                <a href="/dashboard/orders"><img src="/assets/images/organi_shop_logo_dark.svg" alt="Organic Shop"></a>
                <ul>
                    <li <?= ($aside_header_title == 'Orders') ? 'class="active"' : "" ?>><a href="/dashboard/orders">Orders</a></li>
                    <li <?= ($aside_header_title == 'Products') ? 'class="active"' : "" ?>><a href="/dashboard/products">Products</a></li>
                </ul>
            </aside>