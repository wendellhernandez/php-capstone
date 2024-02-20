<?php
    class Cart extends CI_Model{
        public function set_to_cart($product_id){
            $user_id = $this->session->userdata('user_id');
            $quantity = $this->input->post('quantity' , TRUE);

            $query = 'INSERT INTO carts (users_id , products_id , quantity) VALUES (? , ? , ?)';

            $data = array($user_id , $product_id , $quantity);

            $this->db->query($query , $data);
        }
        
        public function update_cart($product_id){
            $user_id = $this->session->userdata('user_id');
            $quantity = $this->input->post('quantity' , TRUE);

            $query = 'DELETE FROM carts 
                WHERE users_id = ?
                AND products_id = ?
                ';

            $data = array($user_id , $product_id);
            $this->db->query($query , $data);

            $query = 'INSERT INTO carts (users_id , products_id , quantity) VALUES (? , ? , ?)';

            $data = array($user_id , $product_id , $quantity);
            $this->db->query($query , $data);
        }

        public function remove_cart($product_id){
            $user_id = $this->session->userdata('user_id');

            $query = 'DELETE FROM carts 
                WHERE users_id = ?
                AND products_id = ?
                ';
                
            $data = array($user_id , $product_id);
            $this->db->query($query , $data);
        }

        public function get_cart_products(){
            $user_id = $this->session->userdata('user_id');

            $query = 
            'SELECT 
                * , 
                sum(carts.quantity) AS carts_quantity,
                sum(carts.quantity) * products.price AS product_total
                FROM carts
                LEFT JOIN products
                ON carts.products_id = products.id
                WHERE carts.users_id = ?
                GROUP BY carts.products_id
                ';

            return $this->db->query($query , array($user_id))->result_array();
        }
    }