<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model');
		is_logged_in();
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
        $data['title'] = 'Data Transaksi';
		$data['user'] = $this->db->get_where('user1', ['username' => $this->session->userdata('username')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('laporan/laporan', $data);
		$this->load->view('templates/footer');
    }

}