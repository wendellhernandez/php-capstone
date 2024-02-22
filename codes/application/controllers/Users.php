<?php
	class Users extends CI_Controller{
		public function signup(){
			$this->User->if_logged_in_redirect();
			$this->load->view('users/signup');
		}

		public function signup_user(){
			$this->User->set_user();
		}

		public function login(){
			$this->User->if_logged_in_redirect();
			$this->load->view('users/login');
		}

		public function login_user(){
			$this->User->get_user();
		}

		public function logout(){
			$this->session->sess_destroy();
			redirect('/login');
		}
	}