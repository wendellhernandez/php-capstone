<?php
    class Orders extends CI_Controller{
        public function admin(){
            $this->User->if_not_logged_in_redirect();

            $data = array(
                'aside_header_title' => 'Orders',
                'first_name' => $this->session->userdata('first_name')
            );

            $this->load->view('orders/admin_orders' , $data);
        }

        public function admin_orders_partial(){
            $this->partial_functions();
        }

        public function update_orders_status(){
            $this->Order->update_order_status();

            $this->partial_functions();
        }

        public function partial_functions(){
            $search = $this->input->post('search' , TRUE);
            $status = $this->input->post('status' , TRUE);

            if(!empty($this->input->post('page' , TRUE))){
                $page = $this->input->post('page' , TRUE);
            }else{
                $page = 1;
            }

            $data = array(
                'orders' => $this->Order->get_orders(),
                'search' => $search,
                'status' => $status,
                'page' => $page,
                'count' => $this->Order->count_orders()
            );

            $this->load->view('partials/admin_orders_partial' , $data);
        }
    }