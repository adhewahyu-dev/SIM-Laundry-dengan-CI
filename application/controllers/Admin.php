<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model');
		$this->load->helper('tgl_indo');
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['user'] = $this->db->get_where('user1', ['username' => $this->session->userdata('username')])->row_array();
		$data['total_user'] = $this->Admin_model->jumlahUser();
		$data['total_pelanggan'] = $this->Admin_model->jumlahPelanggan();
		$data['total_transaksi'] = $this->Admin_model->jumlahTransaksi();
		$data['total_uang_masuk'] = $this->Admin_model->jumlahUangMasuk();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer');
	}

	public function role()
	{
		$data['title'] = 'Role';
		$data['user'] = $this->db->get_where('user1', ['username' => $this->session->userdata('username')])->row_array();

		$data['role'] = $this->db->get('user_role')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/role', $data);
		$this->load->view('templates/footer');
	}

		public function roleAccess($role_id)
	{
		$data['title'] = 'Role Access ';
		$data['user'] = $this->db->get_where('user1', ['username' => $this->session->userdata('username')])->row_array();

		$data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

		$this->db->where('id !=', 1);
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/role-access', $data);
		$this->load->view('templates/footer');
	}


	public function changeAccess()
	{
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');

		$data = [
			'role_id' => $role_id,
			'menu_id' => $menu_id
		];

		$result = $this->db->get_where('user_access_menu', $data);

		if ($result->num_rows() < 1){
			$this->db->insert('user_access_menu', $data);
		} else {
			$this->db->delete('user_access_menu', $data);
		}

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access chaged!</div>');

	}

	public function datauser()
	{
		$data['title'] = 'Olah Data User';
		$data['user'] = $this->db->get_where('user1', ['username' => $this->session->userdata('username')])->row_array();
		$this->load->model('Admin_model', 'datauser');

		$data['dataUser'] = $this->datauser->getDataUser();
		$data['datauser'] = $this->db->get('user_role')->result_array();

		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user1.username]', [
				'is_unique' => 'Username sudah ada! '
			]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' => 'Password tidak sama!',
			'min_length' => 'Password terlalu pendek!'
			]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/datauser', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'name' => htmlspecialchars($this->input->post('name', true)),
				'username' => htmlspecialchars($this->input->post('username', true)),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => htmlspecialchars($this->input->post('role_id', true)),
				'date_created' => time()
			];
			$this->db->insert('user1', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data telah ditambahkan!</div>');
			redirect('admin/datauser');
		}
		
	}

	public function hapus($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('user1');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data telah dihapus!!</div>');
			redirect('admin/datauser');
	}

	public function paket()
	{
		$data['title'] = 'Paket Layanan';
		$data['user'] = $this->db->get_where('user1', ['username' => $this->session->userdata('username')])->row_array();

		$data['paket'] = $this->db->get('paket')->result_array();

		$this->form_validation->set_rules('paket', 'Paket', 'required');
		$this->form_validation->set_rules('harga', 'Harga', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/paket', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'paket' => htmlspecialchars($this->input->post('paket', true)),
				'harga' => htmlspecialchars($this->input->post('harga', true)),
			];
			$this->db->insert('paket', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data layanan telah ditambahkan!</div>');
			redirect('admin/paket');
		}
		
	}

	public function hapusPaket($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('paket');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data telah dihapus!!</div>');
		redirect('admin/paket');
	}

	public function ubahPaket($id)
	{
		$data['title'] = 'Paket Layanan';
		$data['user'] = $this->db->get_where('user1', ['username' => $this->session->userdata('username')])->row_array();
		$data['paket'] = $this->Admin_model->getPaketById($id);
		//$data['paket'] = $this->db->get_where('paket', ['id' => $id])->row_array();

		$this->form_validation->set_rules('paket', 'Paket', 'required|trim');
		$this->form_validation->set_rules('harga', 'Harga', 'required|numeric|trim');

		 if($this->form_validation->run() == FALSE ){
		 		$this->load->view('templates/header', $data);
		 		$this->load->view('templates/sidebar', $data);
		 		$this->load->view('templates/topbar', $data);
		 		$this->load->view('admin/ubah-paket', $data);
		 		$this->load->view('templates/footer');
		 } else {
				// $paket = $this->input->post('paket');
				// $harga = $this->input->post('harga');
				// $id = $this->input->post('id');

				// $this->db->set('name', $name);
				// $this->db->where('id', $id);
				// $this->db->update('paket');
		 		$this->Admin_model->ubahDataPaket();
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data telah ditambahkan!</div>');
				redirect('admin/paket');
		}
		
	}

	public function pengeluaran()
	{
		$data['title'] = 'Pengeluaran';
		$data['user'] = $this->db->get_where('user1', ['username' => $this->session->userdata('username')])->row_array();

		$data['pengeluaran'] = $this->db->get('pengeluaran')->result_array();

		$this->form_validation->set_rules('ket', 'Keterangan', 'required');
		$this->form_validation->set_rules('nominal', 'Nominal', 'required|numeric');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/pengeluaran', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'ket' => htmlspecialchars($this->input->post('ket', true)),
				'nominal' => htmlspecialchars($this->input->post('nominal', true)),
				'tgl' => time()
			];
			$this->db->insert('pengeluaran', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data telah ditambahkan!</div>');
			redirect('admin/pengeluaran');
		}
		
	}

	public function hapuspengeluaran($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('pengeluaran');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data telah dihapus!!</div>');
			redirect('admin/pengeluaran');
	}

	public function laporan(){
        // if($this->input->post('tgl_awal') == '' && $this->input->post('tgl_akhir') == ''){
        //     $data['his'] = $this->putra_model->read_his()->result();
        //     $data['total'] = $this->putra_model->total()->row_array();
           
        //     $this->load->view('laporan/laporan', $data);
        // }else{
        //     $tgl_awal = $this->input->post('tgl_awal');
        //     $tgl_akhir = $this->input->post('tgl_akhir');
        //     $data['tgl_awal'] = $tgl_awal;
        //     $data['tgl_akhir'] = $tgl_akhir;
        //     $data['his'] = $this->putra_model->select_data($tgl_awal, $tgl_akhir)->result();
        //     $this->load->view('laporan/laporan', $data);
        // }
        if($this->input->post('tgl_awal') == '' && $this->input->post('tgl_akhir') == ''){
        		$data['title'] = 'Laporan';
				$data['user'] = $this->db->get_where('user1', ['username' => $this->session->userdata('username')])->row_array();
				$data['transaksi'] = $this->Admin_model->read_transaksi()->result_array();
				$data['total'] = $this->Admin_model->total()->row_array();


				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('templates/topbar', $data);
				$this->load->view('laporan/laporan', $data);
				$this->load->view('templates/footer');
        }else{
        		$data['title'] = 'Laporan';
				$data['user'] = $this->db->get_where('user1', ['username' => $this->session->userdata('username')])->row_array();

        		$tgl_awal = $this->input->post('tgl_awal');
        		$tgl_akhir = $this->input->post('tgl_akhir');
        		$data['tgl_awal'] = $tgl_awal;
        		$data['tgl_akhir'] = $tgl_akhir;
        		$data['transaksi'] = $this->Admin_model->select_data($tgl_awal, $tgl_akhir)->result_array();
        		//$data['pengeluaran'] = $this->Admin_model->select_data($tgl_awal, $tgl_akhir)->result_array();

        		$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('templates/topbar', $data);
				$this->load->view('laporan/laporan', $data);
				$this->load->view('templates/footer');
        }
        
    }

    public function bataltransaksi()
    {
    	$data['title'] = 'Data Batal Transaksi';
		$data['user'] = $this->db->get_where('user1', ['username' => $this->session->userdata('username')])->row_array();
		$this->db->order_by('id', 'DESC');
		$data['recovery'] = $this->db->get('recovery')->result_array();

		if( $this->input->post('keyword') ) {
			$data['recovery'] = $this->Admin_model->cariDataBatalTransaksi();
		}
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/bataltransaksi', $data);
		$this->load->view('templates/footer');

    }

    public function pakaian()
    {
    	$data['title'] = 'Data Jenis Pakaian';
		$data['user'] = $this->db->get_where('user1', ['username' => $this->session->userdata('username')])->row_array();
		$data['pakaian'] = $this->db->get('pakaian')->result_array();

		$this->form_validation->set_rules('pakaian', 'Pakaian', 'required');
		// if( $this->input->post('keyword') ) {
		// 	$data['pakaian'] = $this->Admin_model->cariDataPakaian();
		// }
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/pakaian', $data);
			$this->load->view('templates/footer');
		} else {
			$data = [
				'nama_pakaian' => htmlspecialchars($this->input->post('pakaian', true)),
			];
			$this->db->insert('pakaian', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data pakaian telah ditambahkan!</div>');
			redirect('admin/pakaian');
		}

    }

    public function hapusPakaian($id)
	{
		$this->db->where('id_pakaian', $id);
		$this->db->delete('pakaian');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data telah dihapus!!</div>');
		redirect('admin/pakaian');
	}

	public function ubahPakaian($id)
	{
		$data['title'] = 'Ubah Jenis Pakaian';
		$data['user'] = $this->db->get_where('user1', ['username' => $this->session->userdata('username')])->row_array();
		$data['pakaian'] = $this->Admin_model->getPakaianById($id);

		$this->form_validation->set_rules('pakaian', 'Pakaian', 'required|trim');

		 if($this->form_validation->run() == FALSE ){
		 		$this->load->view('templates/header', $data);
		 		$this->load->view('templates/sidebar', $data);
		 		$this->load->view('templates/topbar', $data);
		 		$this->load->view('admin/ubah-pakaian', $data);
		 		$this->load->view('templates/footer');
		 } else {
				// $paket = $this->input->post('paket');
				// $harga = $this->input->post('harga');
				// $id = $this->input->post('id');

				// $this->db->set('name', $name);
				// $this->db->where('id', $id);
				// $this->db->update('paket');
		 		$this->Admin_model->ubahDataPakaian();
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data telah ditambahkan!</div>');
				redirect('admin/pakaian');
		}
		
	}

}