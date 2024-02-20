<?php
    class Transaction extends CI_Model{
        public function set_shipping_info(){
            $query = 'DELETE FROM shipping_informations';
        }
    }