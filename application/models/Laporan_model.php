<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{


public function getTransaksi()
	{
		$query = "SELECT * FROM `transaksi` 
					INNER JOIN `paket`
					ON `transaksi`.`paket_id` = `paket`.`id`
					INNER JOIN `pelanggan`
					ON `transaksi`.`pelanggan_id` = `pelanggan`.`id`
				";

		return $this->db->query($query)->result_array();
	}

}