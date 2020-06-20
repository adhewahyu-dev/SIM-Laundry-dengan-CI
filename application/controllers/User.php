<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->helper('tgl_indo');
		is_logged_in();
	}

	public function index()
	{
		$data['title'] = 'My Profile';
		$data['user'] = $this->db->get_where('user1', ['username' => $this->session->userdata('username')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/index', $data);
		$this->load->view('templates/footer');
	}


	public function edit()
	{
		$data['title'] = 'Edit profile';
		$data['user'] = $this->db->get_where('user1', ['username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('name', 'Full Name', 'required|trim');

		if ($this->form_validation->run() == false){
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/edit', $data);
			$this->load->view('templates/footer');
		} else {
			$name = $this->input->post('name');
			$username = $this->input->post('username');

			// cek jika ada gambar yang diupload
			$upload_image = $_FILES['image']['name'];

			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '5048';
				$config['upload_path'] = './assets/img/profile/';

				$this->load->library('upload', $config);
					$new_image = $this->upload->data('file_name');
				if ($this->upload->do_upload('image')) {

					$old_image = $data['user1']['image'];
					if ($old_image != 'default.jpg'){
						unlink(FCPATH . 'assets/img/profile/' . $old_image);
					}

					$new_image = $this->upload->data('file_name');
					$this->db->set('image', $new_image);
				} else {
					echo $this->upload->display_errors();
				}
			}

			$this->db->set('name', $name);
			$this->db->where('username', $username);
			$this->db->update('user1');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
  				Akun anda sudah di ubah!
				</div>');
			redirect('user');
		}
		
	}

	public function changePassword()
	{
		$data['title'] = 'Change Password';
		$data['user'] = $this->db->get_where('user1', ['username' => $this->session->userdata('username')])->row_array();

		$this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
		$this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
		$this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/changepassword', $data);
			$this->load->view('templates/footer');
		} else {
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post(new_password1);
			if(!password_verify($current_password, $data['user']['password'])){
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
  				Password lama anda salah
				</div>');
				redirect('user/changepassword');
			} else {
				if($current_password == $new_password) {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
	  				Password baru tidak boleh sama dengan password lama!
					</div>');
					redirect('user/changepassword');
					} else {
						// password sudah oke
						$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

						$this->db->set('password', $password_hash);
						$this->db->where('username', $this->session->userdata('username'));
						$this->db->update('user1');

						$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
	  				Password telah diubah!
					</div>');
					redirect('user/changepassword');
					}
			}
		}
		
	}

	public function pelanggan ()
	{
		$data['title'] = 'Data Pelanggan';
		$data['user'] = $this->db->get_where('user1', ['username' => $this->session->userdata('username')])->row_array();
		$this->db->order_by('id', 'DESC');
		$data['pelanggan'] = $this->db->get('pelanggan')->result_array();
		if( $this->input->post('keyword') ) {
			$data['pelanggan'] = $this->User_model->cariDataPelanggan();
		}
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/pelanggan', $data);
		$this->load->view('templates/footer');

	}

	public function tambahpelanggan()
	{
		$data['title'] = 'Data Pelanggan';
		$data['user'] = $this->db->get_where('user1', ['username' => $this->session->userdata('username')])->row_array();

		$data['pelanggan'] = $this->db->get('pelanggan')->result_array();
		

		$this->form_validation->set_rules('nama', 'Nama', 'required|trim|is_unique[pelanggan.nama]' , [
				'is_unique' => 'Nama pelanggan sudah ada! '
			]);
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
		$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required|trim');
		$this->form_validation->set_rules('telepon', 'Telepon', 'required|numeric|trim');
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' => 'Password tidak sama!',
			'min_length' => 'Password terlalu pendek!'
			]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

			if ($this->form_validation->run() == false) {
				$this->load->view('templates/header', $data);
				$this->load->view('templates/sidebar', $data);
				$this->load->view('templates/topbar', $data);
				$this->load->view('user/tambah-pelanggan', $data);
				$this->load->view('templates/footer');
			} else {
				$data = [
					'nama' => htmlspecialchars($this->input->post('nama', true)),
					'alamat' => htmlspecialchars($this->input->post('alamat', true)),
					'jenis_kelamin' => htmlspecialchars($this->input->post('jk', true)),
					'telepon' => htmlspecialchars($this->input->post('telepon', true)),
					'username' => htmlspecialchars($this->input->post('username', true)),
					'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT)
				];
				$this->db->insert('pelanggan', $data);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data telah ditambahkan!</div>');
				redirect('user/pelanggan');
			}
		

		
		
	}

	public function hapusPelanggan($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('pelanggan');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data telah dihapus!!</div>');
		redirect('user/pelanggan');
	}

	public function ubahPelanggan($id)
	{
		$data['title'] = 'Ubah Data Pelanggan';
		$data['user'] = $this->db->get_where('user1', ['username' => $this->session->userdata('username')])->row_array();
		$data['pelanggan'] = $this->User_model->getPelangganById($id);
		//$data['paket'] = $this->db->get_where('paket', ['id' => $id])->row_array();

		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
		$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required|trim');
		$this->form_validation->set_rules('telepon', 'Telepon', 'required|numeric|trim');
		$this->form_validation->set_rules('username', 'Username', 'required|trim');

		 if($this->form_validation->run() == FALSE ){
		 		$this->load->view('templates/header', $data);
		 		$this->load->view('templates/sidebar', $data);
		 		$this->load->view('templates/topbar', $data);
		 		$this->load->view('user/ubah_pelanggan', $data);
		 		$this->load->view('templates/footer');
		 } else {
		 		$this->User_model->ubahDataPelanggan();
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data telah ditambahkan!</div>');
				redirect('user/pelanggan');
		}
		
	}

	public function transaksi ()
	{
		$data['title'] = 'Data Transaksi';
		$data['user'] = $this->db->get_where('user1', ['username' => $this->session->userdata('username')])->row_array();
		//$this->load->model('User_model', 'transaksi');
		$this->db->order_by('id', 'DESC');
		$data['transaksi'] = $this->db->get('transaksi2')->result_array();

		//$data['Transaksi'] = $this->transaksi->getTransaksi();
		//$data['transaksi'] = $this->db->get('paket')->result_array();

		if( $this->input->post('keyword') ) {
			$data['transaksi'] = $this->User_model->cariDataTransaksi();
		}
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/transaksi', $data);
		$this->load->view('templates/footer');

	}

		public function tambahtransaksi ()
	{
			$data['title'] = 'Transaksi';
		$data['user'] = $this->db->get_where('user1', ['username' => $this->session->userdata('username')])->row_array();
		$data['tmasakan']=$this->User_model->tampildata('pakaian','id_pakaian');
		$data['kodeunik'] = $this->User_model->buat_kode(); 
		$data['pelanggan'] = $this->db->get('pelanggan')->result_array();
		$data['orders']=$this->User_model->no_invoice();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/tambah-transaksi', $data);
	}

	public function hapusTransaksi($id)
	{
		$data['title'] = 'Pembatalan Orderan';
		$data['user'] = $this->db->get_where('user1', ['username' => $this->session->userdata('username')])->row_array();
		$data['transaksi'] = $this->User_model->getTransaksiById($id);

		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');

		 if($this->form_validation->run() == FALSE ){
		 		$this->load->view('templates/header', $data);
		 		$this->load->view('templates/sidebar', $data);
		 		$this->load->view('templates/topbar', $data);
		 		$this->load->view('user/hapustransaksi', $data);
		 		$this->load->view('templates/footer');
		 } else {
		 		$data = [
					'tgl_masuk' => htmlspecialchars($this->input->post('tgl', true)),
					'no_transaksi' => htmlspecialchars($this->input->post('no_transaksi', true)),
					'pelanggan' => htmlspecialchars($this->input->post('pelanggan', true)),
					'penerima' => htmlspecialchars($this->input->post('penerima', true)),
					'paket' => htmlspecialchars($this->input->post('paket', true)),
					'harga' => htmlspecialchars($this->input->post('harga', true)),
					'berat' => htmlspecialchars($this->input->post('berat', true)),
					'total' => htmlspecialchars($this->input->post('total', true)),
					'keterangan' => htmlspecialchars($this->input->post('keterangan', true)),
					'tgl_pembatalan' => time()
				];
				$this->db->insert('recovery', $data);

				$this->db->where('id', $id);
				$this->db->delete('transaksi2');
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">1 Transaksi dibatalkan!</div>');
				redirect('user/transaksi');
		}


		
		// $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data telah dihapus!!</div>');
		// redirect('user/transaksi');
	}

	public function editTransaksi($id)
	{
		$data = [
			"status" => '1'
		];

		$this->db->where('id', $id);
		$this->db->update('transaksi2', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">1 pakaian sudah selesai!</div>');
		redirect('user/transaksi');
	}
	public function editTransaksii($id)
	{
		$data = [
			"status" => '2',
			"tgl_ambil" => date('Y-m-d')
		];

		$this->db->where('id', $id);
		$this->db->update('transaksi2', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">1 pakaian diambil!</div>');
		redirect('user/transaksi');
	}

	public function cetak($id)
	{
		$data['title'] = 'Cetak Nota Penerimaan Pakaian';
		$data['user'] = $this->db->get_where('user1', ['username' => $this->session->userdata('username')])->row_array();
		// $this->load->model('User_model', 'cetak');
		$data['transaksi'] = $this->User_model->getTransaksiCetakById($id);

		$data['tcetak']=$this->User_model->tampiljoin_where('detail_orders','pakaian','id_pakaian','id_detail_orders',$id);
		

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/cetak', $data);
		$this->load->view('templates/footer');
	}

	public function cetakpembayaran($id)
	{
		$data['title'] = 'Cetak Nota Pembayaran';
		$data['user'] = $this->db->get_where('user1', ['username' => $this->session->userdata('username')])->row_array();
		$data['transaksi'] = $this->User_model->getTransaksiCetakById($id);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/cetakpembayaran', $data);
		$this->load->view('templates/footer');
	}

	// transaksi lagi
	public function transaksilagi()
	{
		$data['title'] = 'Transaksi Lagi';
		$data['user'] = $this->db->get_where('user1', ['username' => $this->session->userdata('username')])->row_array();
		$data['tmasakan']=$this->User_model->tampildata('pakaian','id');
		$data['kodeunik'] = $this->User_model->buat_kode(); 
		$data['pelanggan'] = $this->db->get('pelanggan')->result_array();
		$data['orders']=$this->User_model->no_invoice();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/transaksilagi', $data);
		//$this->load->view('templates/footer');
	}

	public function simpan_keranjang()
	{ //fungsi tambah keranjang
            $data = array(
                'id' => $this->input->post('id'), 
                'name' => $this->input->post('nama_pakaian'), 
                'price' => '0',
                'qty' => '1',
                'coupon' =>'0' 

                 
            );
            $this->cart->insert($data); // cara simpan menggunakan cart
            echo $this->tampil_keranjang(); //tampilkan cart setelah ditambah
    }

    public function load_keranjang()
    { //tampil data keranjang
            echo $this->tampil_keranjang();
    }

    public function tampil_keranjang()
    { //Fungsi untuk menampilkan Cart
            $output = '';
            $no = 0;
            foreach ($this->cart->contents() as $items) {
                $no++;
                $output .='
                    <tr>
                        <td><input type=hidden value="'.$items['id'].'" name="id_pakaian[]">'.$items['name'].'</td>
                        
                        <td><input type=hidden value="'.$items['qty'].'" name="qty[]">'.$items['qty'].'</td>
                        
                        
                        <td><button type="button" id="'.$items['rowid'].'" class="hapus_cart btn btn-danger btn-xs">Hapus</button></td>
                    </tr>
                ';
            }
           
            return $output;
    }

    public function hapus_cart(){ //fungsi untuk menghapus item cart
            $data = array(
                'rowid' => $this->input->post('row_id'), 
                'qty' => 0, 
            );
            $this->cart->update($data);
            echo $this->tampil_keranjang();
    }

    public function simpantransaksi()
        {   
            $data= array('id_orders' => htmlspecialchars($this->input->post('no_orders', true)),
                         'penerima' => htmlspecialchars($this->input->post('penerima', true)),
                         'status' => 0
                        );
            $query=$this->User_model->simpandata('orders', $data);
            $datatransaksi= array('tgl_masuk' => date('Y-m-d'),
                         		  'id_orders' => htmlspecialchars($this->input->post('no_orders', true)),
                                  'pelanggan' => htmlspecialchars($this->input->post('pelanggan_id', true)),
                                  'penerima' => htmlspecialchars($this->input->post('penerima', true)),
                                  'paket' => htmlspecialchars($this->input->post('paket_id', true)),
                                  'harga' => htmlspecialchars($this->input->post('hrg', true)),
						          'berat' => htmlspecialchars($this->input->post('berat', true)),
						          'total' => htmlspecialchars($this->input->post('total', true)),
						          'status' => 0,
						          'rating' => 0,
						          'komentar' => ''
						    );
            $query=$this->User_model->simpandata('transaksi2',$datatransaksi);

                $id_orders=$this->input->post('no_orders');
                $id=$this->input->post('id_pakaian');
                $datadetail=array();
                    foreach ($id as $key => $value) {
                        $datadetail[]= array('id_orders' => $id_orders,
                                             'id_pakaian' => $_POST['id_pakaian'][$key],
                                             'banyak' => $_POST['qty'][$key]
                                        ) ;
                    }
                $query=$this->User_model->simpan_multi('detail_orders',$datadetail);
                if($query){
                    $this->session->set_flashdata('info','Transaksi berhasil disimpan');
                    $this->cart->destroy();
                    redirect('user/transaksi');
                }else{
                    $this->session->set_flashdata('info','Transaksi gagal disimpan');
                
                    redirect('user/transaksi');
                }
                
        }






}