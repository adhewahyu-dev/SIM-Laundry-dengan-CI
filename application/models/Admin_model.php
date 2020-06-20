<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{
	public function getDataUser()
	{
		$query = "SELECT `user1`.*, `user_role`.`role` 
					FROM `user1` JOIN `user_role`
					ON `user1`.`role_id` = `user_role`.`id`
					ORDER BY id DESC
				";

		return $this->db->query($query)->result_array();
	}

	public function getPaketById($id)
	{
		return  $this->db->get_where('paket', ['id' => $id])->row_array();

	}

	public function getPakaianById($id)
	{
		return  $this->db->get_where('pakaian', ['id_pakaian' => $id])->row_array();

	}

	public function ubahDataPaket()
	{
		$data = [
			"paket" => $this->input->post('paket', true),
			"harga" => $this->input->post('harga', true)
		];

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('paket', $data);
		redirect('admin/paket');
	}

	public function ubahDataPakaian()
	{
		$data = [
			"nama_pakaian" => $this->input->post('pakaian', true)
		];

		$this->db->where('id_pakaian', $this->input->post('id'));
		$this->db->update('pakaian', $data);
		redirect('admin/pakaian');
	}

	public function jumlahUser()
	{
		$query = $this->db->get('user1');
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		} else {
			return 0;
		}
	}
	public function jumlahPelanggan()
	{
		$query = $this->db->get('pelanggan');
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		} else {
			return 0;
		}
	}
	public function jumlahTransaksi()
	{
		$query = $this->db->get('transaksi');
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		} else {
			return 0;
		}
	}
	public function jumlahUangMasuk()
	{
		$this->db->select('SUM(total) as total');
		$this->db->from('transaksi');
		return $this->db->get()->row()->total;
	}	

	// public function getTransaksi()
	// {
	// 	$query = "SELECT * FROM `transaksi` 
	// 				INNER JOIN `paket`
	// 				ON `transaksi`.`paket_id` = `paket`.`id`
	// 				INNER JOIN `pelanggan`
	// 				ON `transaksi`.`pelanggan_id` = `pelanggan`.`id`
	// 				WHERE status =1
	// 			";

	// 	return $this->db->query($query)->result_array();
	// }

	public function read_transaksi(){
        return $this->db->get_where('transaksi2', array('status' => 2));
    }
    public function read_pengeluaran(){
        return $this->db->get_where('pengeluaran');
    }

	 public function total(){
           return $this->db->query("SELECT sum(total) AS total FROM transaksi2");

    }

    public function select_data($tgl_awal, $tgl_akhir)
    {
    
        $this->db->where('tgl_ambil >=',$tgl_awal);
        $this->db->where('tgl_ambil <=',$tgl_akhir);
        return $this->db->get('transaksi2');

        $this->db->where('tanggal >=',$tgl_awal);
        $this->db->where('tanggal <=',$tgl_akhir);
        return $this->db->get('pengeluaran');
    }

    public function select_dataa($tgl_awal, $tgl_akhir)
    {
    	$this->db->where('tanggal >=',$tgl_awal);
        $this->db->where('tanggal <=',$tgl_akhir);
        return $this->db->get('pengeluaran');
    }

    public function cariDataBatalTransaksi()
	{

		$keyword = $this->input->post('keyword', true);
		$this->db->like('pelanggan', $keyword);
		return $this->db->get('recovery')->result_array();

	}

	public function cariDataPakaian()
	{

		$keyword = $this->input->post('keyword', true);
		$this->db->like('nama_pakaian', $keyword);
		return $this->db->get('pakaian')->result_array();

	}	

}