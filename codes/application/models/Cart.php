<?php
    class Cart extends CI_Model{
        public function set_to_cart($product_id){
            $user_id = $this->session->userdata('user_id');
            $quantity = $this->input->post('quantity' , TRUE);

            $query = 'INSERT INTO carts (user_id , product_id , quantity) VALUES (? , ? , ?)';

            $data = array($user_id , $product_id , $quantity);

            $this->db->query($query , $data);
        }
        
        public function update_cart($product_id){
            $user_id = $this->session->userdata('user_id');
            $quantity = $this->input->post('quantity' , TRUE);

            $query = 'DELETE FROM carts 
                WHERE user_id = ?
                AND product_id = ?
                ';

            $data = array($user_id , $product_id);
            $this->db->query($query , $data);

            $query = 'INSERT INTO carts (user_id , product_id , quantity) VALUES (? , ? , ?)';

            $data = array($user_id , $product_id , $quantity);
            $this->db->query($query , $data);
        }

        public function remove_cart($product_id){
            $user_id = $this->session->userdata('user_id');

            $query = 'DELETE FROM carts 
                WHERE user_id = ?
                AND product_id = ?
                ';
                
            $data = array($user_id , $product_id);
            $this->db->query($query , $data);
        }

        public function get_cart_products(){
            $user_id = $this->session->userdata('user_id');

            $query = 'SELECT 
                * , 
                sum(carts.quantity) AS carts_quantity,
                sum(carts.quantity) * products.price AS product_total,
                products.id AS product_id,
                products.name AS product_name,
                products.price AS product_price
                FROM carts
                LEFT JOIN products
                ON carts.product_id = products.id
                WHERE carts.user_id = ?
                GROUP BY carts.product_id
                ';

            return $this->db->query($query , array($user_id))->result_array();
        }

        public function get_cart_total_price(){
            $cart_products = $this->get_cart_products();
            $sum = 0;

            foreach($cart_products as $cart_product){
                $sum += $cart_product['product_total'];
            }

            return $sum;
        }

        public function delete_user_cart(){
            $user_id = $this->session->userdata('user_id');
            $query = 'DELETE FROM carts WHERE user_id = ?;';

            $this->db->query($query , array($user_id));
        }
    }