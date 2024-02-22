<?php
    class Product extends CI_Model{
        public function get_products(){
            $query = 'SELECT 
                products.name AS product_name,
                products.price AS product_price,
                products.id AS product_id,
                categories.name AS category_name,
                products.stocks AS inventory,
                products.sold AS products_sold
                FROM products
                INNER JOIN categories
                ON products.category_id = categories.id
                WHERE products.name LIKE ? 
                AND categories.name LIKE ?
                ';

            $search = $this->input->post('search' , TRUE);
            $category = $this->input->post('category' , TRUE);
            $data = array("%$search%" , "%$category%");

            return $this->db->query($query , $data)->result_array();
        }

        public function get_product_by_id($product_id){
            $query = 'SELECT * FROM products WHERE id = ?';

            return $this->db->query($query , array($product_id))->row_array();
        }

        public function get_similar_products($product_id){
            $query = 'SELECT * FROM products WHERE id = ?';
            $result = $this->db->query($query , array($product_id))->row_array();
            $category_id = $result['category_id'];

            $query = 'SELECT * FROM products 
                WHERE category_id = ? AND
                id != ?
                LIMIT 5
                ';
            return $this->db->query($query , array($category_id , $product_id))->result_array();
        }

        public function set_product_sold(){
            $cart_products = $this->Cart->get_cart_products();

            foreach($cart_products as $cart_product){
                $product_id = $cart_product['product_id'];
                $product = $this->get_product_by_id($product_id);
                $sold_past = $product['sold'];
                $sold = $sold_past + $cart_product['carts_quantity'];
                $stocks_past = $product['stocks'];
                $stocks = $stocks_past - $cart_product['carts_quantity'];

                $query = 'UPDATE products SET sold = ? , stocks = ? WHERE id = ?';

                $data = array($sold , $stocks , $product_id);

                $this->db->query($query , $data);
            }
        }

        public function get_categories(){
            $query = 'SELECT 
                categories.name AS category_name ,
                categories.id AS category_id,
                count(*) as product_count
                FROM products
                INNER JOIN categories
                ON products.category_id = categories.id
                GROUP BY categories.name;
            ';

            return $this->db->query($query)->result_array();
        }

        public function count_all_products(){
            $categories = $this->Product->get_categories();
            $sum = 0;

            foreach($categories as $category){
                $sum += $category['product_count'];
            }

            return $sum;
        }

        public function set_sold_count(){
            $query = 'UPDATE products 
                SET sold = ?
                WHERE ;
            ';
        }

        public function set_product(){
            $this->validate_set_product_input();

            $query = 'INSERT INTO products 
                (name , description , category_id , price , stocks)
                VALUES
                (? , ? , ? , ? , ?);
            ';

            $data = array();

            $this->db->query($query , $data);
        }

        public function validate_set_product_input(){
            $this->form_validation->set_rules('product_name' , 'Product Name' , 'trim|required|min_length[2]');
            $this->form_validation->set_rules('description' , 'Description' , 'trim|required|min_length[2]');
            $this->form_validation->set_rules('price' , 'Price' , 'trim|required|numeric');
            $this->form_validation->set_rules('inventory' , 'Inventory' , 'trim|required|numeric');

            $this->set_product_errors();
        }

        public function set_product_errors(){
            if(!$this->form_validation->run()){
                $json_data = array(
                    'first_name' => form_error('first_name'),
                    'last_name' => form_error('last_name'),
                    'email' => form_error('email'),
                    'password' => form_error('password'),
                    'confirm_password' => form_error('confirm_password'),
                    'success' => ''
                );

                echo json_encode($json_data);
                die();
            }else{
                $json_data = array(
                    'first_name' => '',
                    'last_name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'success' => 'Signup Successful'
                );

                echo json_encode($json_data);
            }
        }
    }