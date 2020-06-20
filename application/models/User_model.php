<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
	public function tampildata($nama_table, $urut_id)
	{
		return $this->db->from($nama_table)
					->order_by($urut_id, 'DESC')
                    ->get('');
    } 

	public function getPelangganById($id)
	{
		return  $this->db->get_where('pelanggan', ['id' => $id])->row_array();

	}

	public function ubahDataPelanggan()
	{
		$data = [
			"nama" => $this->input->post('nama', true),
			"alamat" => $this->input->post('alamat', true),
			"jenis_kelamin" => $this->input->post('jk', true),
			"telepon" => $this->input->post('telepon', true),
			"username" => $this->input->post('username', true)
		];

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('pelanggan', $data);
		redirect('user/pelanggan');
	}

	public function cariDataPelanggan()
	{
		$keyword = $this->input->post('keyword', true);
		$this->db->like('nama', $keyword);
		return $this->db->get('pelanggan')->result_array();
	}

	// public function getTransaksi()
	// {
	// 	$query = "SELECT * FROM `transaksi` 
	// 				INNER JOIN `paket`
	// 				ON `transaksi`.`paket_id` = `paket`.`id`
	// 			";

	// 	return $this->db->query($query)->result_array();
	// }

	public function cariDataTransaksi()
	{

		$keyword = $this->input->post('keyword', true);
		$this->db->like('pelanggan', $keyword);
		return $this->db->get('transaksi2')->result_array();

	}	

	public function getTransaksiById($id)
	{
		return  $this->db->get_where('transaksi2', ['id' => $id])->row_array();
	}

	public function ubahDataTransaksi()
	{
		$data = [
			"status" => '1'
		];

		$this->db->where('id', $this->input->post('id'));
		$this->db->update('transaksi', $data);
		redirect('user/transaksi');
	}

	public function getTransaksiCetakById($id)
	{
		return  $this->db->get_where('transaksi2', ['id' => $id])->row_array();

	}

public function buat_kode()   {
		  $this->db->select('RIGHT(transaksi2.id_orders,4) as kode', FALSE);
		  $this->db->order_by('id_orders','DESC');    
		  $this->db->limit(1);    
		  $query = $this->db->get('transaksi2');      //cek dulu apakah ada sudah ada kode di tabel.    
		  if($query->num_rows() <> 0){      
		   //jika kode ternyata sudah ada.      
		   $data = $query->row();      
		   $kode = intval($data->kode) + 1;    
		  }
		  else {      
		   //jika kode belum ada      
		   $kode = 1;    
		  }
		  $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
		  $kodejadi = "T".$kodemax;    // hasilnya ODJ-9921-0001 dst.
		  return $kodejadi;  
	}

public function simpan_multi($nama_table,$data){
        return $this->db->insert_batch($nama_table, $data);
    }

public function simpandata($nama_table,$data){
        return $this->db->insert($nama_table, $data);
    }

public function no_invoice(){
        // pada table orders (Tambah 's'), AI (Auto Increament) dihilangkan 
        $n = $this->db->query("SELECT MAX(RIGHT(id_orders,4)) AS kd_max FROM transaksi2 WHERE DATE(tgl_masuk)=CURDATE()");
        $kd = "";
        if($n->num_rows()>0){
            foreach($n->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return date('dmy').$kd;
    }

public function tampiljoin_where($tableawal,$tabledua,$idgabung,$idutama,$id){
        $query=$this->db->select ('*')
                        ->from($tableawal)
                        ->where('id_orders',$id)
                        ->join($tabledua,''.$tableawal.'.'.$idgabung.'='.$tabledua.'.'.$idgabung.'','left')
                        ->order_by($idutama,'DESC')
                        ->get()->result();;
        return $query;
    }

}