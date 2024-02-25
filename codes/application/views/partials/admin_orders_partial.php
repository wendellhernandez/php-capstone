                <form action="/orders/admin_orders_partial" method="post" class="search_form">
                    <input type="text" name="search" placeholder="Search Orders" value="<?= $search ?>">
                    <input type="hidden" name="status" value="<?= $status ?>">
                </form>
                <form class="status_form">
                    <h3>Status</h3>
                    <ul>
                        <form action=""></form>
                        <li>
                            <form action="/orders/admin_orders_partial" method="post" class="status_forms">
                                <input type="hidden" name="status" value="">
                                <input type="hidden" name="search" value="<?= $search ?>">
                                <button type="submit" <?= ($status == "") ? "class='active'" : "" ?>>
                                    <span><?= $count['All Orders'] ?></span><img src="/assets/images/all_orders_icon.svg" alt="#"><h4>All Orders</h4>
                                </button>
                            </form>
                        </li>
                        <li>
                            <form action="/orders/admin_orders_partial" method="post" class="status_forms">
                                <input type="hidden" name="status" value="Pending">
                                <input type="hidden" name="search" value="<?= $search ?>">
                                <button type="submit" <?= ($status == "Pending") ? "class='active'" : "" ?>>
                                    <span><?= $count['Pending'] ?></span><img src="/assets/images/pending_icon.svg" alt="#"><h4>Pending</h4>
                                </button>
                            </form>
                        </li>
                        <li>
                            <form action="/orders/admin_orders_partial" method="post" class="status_forms">
                                <input type="hidden" name="status" value="On-Process">
                                <input type="hidden" name="search" value="<?= $search ?>">
                                <button type="submit" <?= ($status == "On-Process") ? "class='active'" : "" ?>>
                                    <span><?= $count['On-Process'] ?></span><img src="/assets/images/on_process_icon.svg" alt="#"><h4>On-Process</h4>
                                </button>
                            </form>
                        </li>
                        <li>
                            <form action="/orders/admin_orders_partial" method="post" class="status_forms">
                                <input type="hidden" name="status" value="Shipped">
                                <input type="hidden" name="search" value="<?= $search ?>">
                                <button type="submit" <?= ($status == "Shipped") ? "class='active'" : "" ?>>
                                    <span><?= $count['Shipped'] ?></span><img src="/assets/images/shipped_icon.svg" alt="#"><h4>Shipped</h4>
                                </button>
                            </form>
                        </li>
                        <li>
                            <form action="/orders/admin_orders_partial" method="post" class="status_forms">
                                <input type="hidden" name="status" value="Delivered">
                                <input type="hidden" name="search" value="<?= $search ?>">
                                <button type="submit" <?= ($status == "Delivered") ? "class='active'" : "" ?>>
                                    <span><?= $count['Delivered'] ?></span><img src="/assets/images/delivered_icon.svg" alt="#"><h4>Delivered</h4>
                                </button>
                            </form>
                        </li>
                    </ul>
                </form>
                <div>
                    <h3><?= ($status == "") ? "All Orders" : $status ?> (<?= count($orders) ?>)</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Order ID #</th>
                                <th>Order Date</th>
                                <th>Receiver</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
    for($i=6*($page-1); $i<6*$page; $i++){
        if(!empty($orders[$i])){
?>
                            <tr>
                                <td><span><a href="/orders/show/<?= $orders[$i]['order_id'] ?>"><?= $orders[$i]['order_id'] ?></a></span></td>
                                <td><span><?= $orders[$i]['order_date'] ?></span></td>
                                <td><span><?= $orders[$i]['full_name'] ?><span><?= $orders[$i]['full_address'] ?></span></span></td>
                                <td><span>$ <?= $orders[$i]['order_total_amount'] ?></span></td>
                                <td>
                                    <form action="/orders/update_orders_status" method="post" class="status_picker">
                                        <select class="selectpicker" name="status_picker">
                                            <option value="Pending" <?= ($orders[$i]['order_status'] == "Pending") ? "selected" : "" ?>>Pending</option>
                                            <option value="On-Process" <?= ($orders[$i]['order_status'] == "On-Process") ? "selected" : "" ?>>On-Process</option>
                                            <option value="Shipped" <?= ($orders[$i]['order_status'] == "Shipped") ? "selected" : "" ?>>Shipped</option>
                                            <option value="Delivered" <?= ($orders[$i]['order_status'] == "Delivered") ? "selected" : "" ?>>Delivered</option>
                                        </select>
                                        <input type="hidden" name="order_id" value="<?= $orders[$i]['order_id'] ?>">
                                        <input type="hidden" name="status" value="<?= $status ?>">
                                        <input type="hidden" name="search" value="<?= $search ?>">
                                        <input type="hidden" name="page" value="<?= $page ?>">
                                    </form>
                                </td>
                            </tr>
<?php
        }
    }
?>
                        </tbody>
                    </table>
                </div>
                <div class="pagination">
<?php
    for($i=0; $i<count($orders)/6; $i++){
?>
                    <form action="/orders/admin_orders_partial" class="pagination_form" method="post">
                        <input type="hidden" name="page" value="<?= $i+1 ?>">
                        <input type="hidden" name="status" value="<?= $status ?>">
                        <input type="hidden" name="search" value="<?= $search ?>">
                        <input type="submit" value="<?= $i+1 ?>">
                    </form>
<?php
    }
?>
                </div>