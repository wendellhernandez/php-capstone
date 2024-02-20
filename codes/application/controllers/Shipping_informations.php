<?php
    class Shipping_informations extends CI_Controller{
        public function add_shipping_info(){
            $this->Shipping_information->set_shipping_info();
        }
    }