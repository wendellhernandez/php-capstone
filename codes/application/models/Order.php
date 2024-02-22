<?php
    class Order extends CI_Model{
        public function set_orders(){
            $cart_products = $this->Cart->get_cart_products();
            $user_id = $this->session->userdata('user_id');
            $total_price = $this->Cart->get_cart_total_price();
            $shipping_fee = count($cart_products) * 1.7;
            $total_plus_shipping = $total_price + $shipping_fee;
            $order_id = $this->get_latest_order_id() + 1;

            $query = 'INSERT INTO orders(id , user_id , total_amount)
                VALUES(? , ? , ?);
            ';

            $this->db->query($query , array($order_id , $user_id , $total_plus_shipping));

            foreach($cart_products as $cart_product){
                $query = 'INSERT INTO 
                    order_details(order_id , product_name , price , quantity , total)
                    VALUES
                    (? , ? , ? , ? , ?);
                ';

                $data = array($order_id , $cart_product['product_name'] , $cart_product['product_price'] , $cart_product['carts_quantity'] , $cart_product['product_total']);

                $this->db->query($query , $data);
            }
        }

        public function get_latest_order_id(){
            $query = 'SELECT id FROM orders
                ORDER BY id DESC
                LIMIT 1
            ';

            $result = $this->db->query($query)->row_array();

            if(empty($result['id'])){
                return 0;
            }else{
                return $result['id'];
            }
        }

        public function get_orders(){
            $search = $this->input->post('search' , TRUE);
            $status = $this->input->post('status' , TRUE);

            $query = 'SELECT 
                orders.id AS order_id,
                date_format(orders.created_at , "%m-%d-%Y") AS order_date,
                concat(shipping_informations.first_name , " " , shipping_informations.last_name) AS full_name,
                concat(shipping_informations.address_1 , ", " , shipping_informations.city , ", " , shipping_informations.state , " " , shipping_informations.zip) AS full_address,
                orders.total_amount AS order_total_amount,
                orders.status AS order_status
                FROM orders
                LEFT JOIN shipping_informations
                ON orders.user_id = shipping_informations.user_id
                WHERE (shipping_informations.first_name LIKE ?
                    OR shipping_informations.last_name LIKE ?)
                AND orders.status LIKE ?
                ORDER BY orders.id DESC
            ';

            $data = array("%$search%" , "%$search%" , "%$status%");

            return $this->db->query($query , $data)->result_array();
        }

        public function update_order_status(){
            $order_id = $this->input->post('order_id' , TRUE);
            $status_picker = $this->input->post('status_picker' , TRUE);

            $query = 'UPDATE orders SET status = ? WHERE id = ?;';

            $this->db->query($query , array($status_picker , $order_id));
        }

        public function count_orders(){
            $count = array(
                'All Orders' => 0,
                'Pending' => 0,
                'On-Process' => 0,
                'Shipped' => 0,
                'Delivered' => 0,
            );

            $query = 'SELECT count(*) as status_count , status
                FROM orders
                GROUP BY status;
            ';

            $results = $this->db->query($query)->result_array();

            if(!empty($results)){
                foreach($results as $result){
                    $count[$result['status']] = $result['status_count'];
                }
    
                $query = 'SELECT * FROM orders;';
    
                $results = $this->db->query($query)->result_array();
    
                $count['All Orders'] = count($results);
            }

            return $count;
        }
    }