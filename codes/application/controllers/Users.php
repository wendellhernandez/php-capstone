<?php
	class Users extends CI_Controller{
		public function signup(){
			$this->if_logged_in_redirect();
			$this->load->view('users/signup');
		}

		public function signup_user(){
			$this->User->set_user();
		}

		public function login(){
			$this->if_logged_in_redirect();
			$this->load->view('users/login');
		}

		public function login_user(){
			$this->User->get_user();
		}

		public function logout(){
			$this->session->sess_destroy();
			redirect('/login');
		}

		public function if_logged_in_redirect(){
			if($this->is_logged_in()){
				redirect('/products');
			}
		}

		public function is_logged_in(){
			if(empty($this->session->userdata('user_id'))){
				return false;
			}else{
				return true;
			}
		}
	}