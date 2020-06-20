<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');

	}
	public function index()
	{
		// if ($this->session->userdata('username')) {
		// 	redirect('user');
		//}

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if( $this->form_validation->run() == false ) {
			$data['title'] = 'Login Page';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		} else {
			// validasi berhasil
			$this->_login();
		}
	}


	private function _login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user1', ['username' => $username])->row_array();

		// usernya ada
		if($user){
			// cek password
			if(password_verify($password, $user['password'])) {
				//
				$data = [
					'username' => $user['username'],
					'role_id' => $user['role_id']
				];
				$this->session->set_userdata($data);
				redirect('user');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
  					Password salah!
				</div>');
			redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
  				Username belum terdaftar!
				</div>');
			redirect('auth');
		}
			
	}

	public function registration()
	{
		if ($this->session->userdata('email')) {
			redirect('user');
		}
		
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user1.username]', [
				'is_unique' => 'Username sudah ada! '
			]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' => 'Password tidak sama!',
			'min_length' => 'Password terlalu pendek!'
			]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

		if( $this->form_validation->run() == false ) {
			$data['title'] = 'WPU User Registration';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/registration');
			$this->load->view('templates/auth_footer');
		} else {
			$data = [
				'name' => htmlspecialchars($this->input->post('name', true)),
				'username' => htmlspecialchars($this->input->post('username', true)),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'date_created' => time()
			];

			$this->db->insert('user1', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
  				Selamat! akun anda sudah dibuat. silahkan login.
				</div>');
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('role_id');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
  				You have been logged out!
				</div>');
			redirect('auth');
	}

	public function blocked()
	{
		$this->load->view('auth/blocked');
	}
}