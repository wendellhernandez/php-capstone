<?php
    class Product extends CI_Model{
        public function get_products(){
            $query = 'SELECT 
                products.name AS product_name,
                products.price AS product_price,
                products.id AS product_id
                FROM products
                INNER JOIN categories
                ON products.categories_id = categories.id
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
            $category_id = $result['categories_id'];

            $query = 'SELECT * FROM products 
                WHERE categories_id = ? AND
                id != ?
                LIMIT 5
                ';
            return $this->db->query($query , array($category_id , $product_id))->result_array();
        }

        public function get_categories(){
            $query = 'SELECT 
                categories.name AS category_name ,
                count(*) as product_count
                FROM products
                INNER JOIN categories
                ON products.categories_id = categories.id
                GROUP BY categories.name
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
    }