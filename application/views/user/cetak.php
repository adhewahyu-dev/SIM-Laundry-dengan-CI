<div class="container">
	<div class="row mt-8">
		<div class="col-md-10,5">
			
			<div class="card">
			  <div class="card-header">
			   Nota Transaksi
			  </div>
			  <div class="card-body" id="print">
			  	<table width="1000" border="0" height="500">
			  		<tr>
			  			<td colspan="2" align="center"><h5>Rumah Laundry Al-Kautsar</h5><br>Pondok Pesantren Nurul Jadid Paiton Probolinggo</td>
			  			<td>
			  				
			  				<table>
			  					<tr>
			  						<td><h5 class="card-title">No Transaksi   :  <?= $transaksi['id_orders']; ?></h5></td>
			  					</tr>
			  					<tr>
			  						<td><h5 class="card-title">Diterima Tgl.  :  <?= longdate_indo($transaksi['tgl_masuk']); ?></h5></td>
			  					</tr>
			  					<tr>
			  						<td><h5 class="card-title">Diambil Tgl.   :  -</h5></td>
			  					</tr>
			  					<tr>
			  						<td><h5 class="card-title">Nama Pelanggan :  <?= $transaksi['pelanggan']; ?></h5></td>
			  					</tr>
			  				</table>
			  			</td>
			  			
			  		</tr>
			  		<tr>
			  			<td colspan="4"><small class="text-danger pl-3">*Note = Tanda penerimaan pakaian</small></td>
			  		</tr>
			  		<tr>
			  			<td colspan="3">
			  				
			  				<table width="950" border="1" class="table table-bordered">
			  					<thead class="thead-dark">
				  					<tr align="center">
				  						<td>Paket Layanan yang dipilih</td>
				  						<td>Harga per-Kg</td>
				  						<td>Berat Pakaian</td>
				  						<td>Nominal</td>
				  					</tr>
				  				</thead>
				  				<tbody>
				  					<tr>
				  						<td><?= $transaksi['paket']; ?></td>
				  						<td><?= "Rp " . number_format($transaksi['harga']); ?></td>
				  						<td><?= $transaksi['berat']; ?></td>
				  						<td><?= "Rp " . number_format($transaksi['total']); ?></td>
				  					</tr>
				  					<tr height="50">
				  						<td></td>
				  						<td></td>
				  						<td></td>
				  						<td>-</td>
				  					</tr>
				  					<tr height="50">
				  						<td colspan="3" align="center"> TOTAL BIAYA </td>
				  						
				  						<td><?= "Rp " . number_format($transaksi['total']); ?></td>
				  					</tr>
				  				</tbody>
			  				</table>	

			  				<table width="500" border="1" class="table-bordered">
			  					<thead>
			  						<tr align="center">
			  							<td>No</td>
			  							<td>Jenis Pakaian</td>
			  							<td>Banyak</td>
			  						</tr>
			  					</thead>
			  					<tbody>
			  						<?php
		                                $id_orders = $this->db->query("SELECT * FROM detail_orders WHERE id_orders = '$transaksi[id_orders]' ")->result();
		                                $no = 1;
		                              
		                                foreach ($id_orders as $i) {
		                                    $barang = $this->db->query("SELECT * FROM pakaian WHERE id_pakaian = '$i->id_pakaian' ")->row_array();

		                            ?>

		                                    <tr>
		                                        <td align="center"><?=$no?></td>
		                                        <td> &nbsp;<?=$barang['nama_pakaian']?></td>
		                                        <td align="center"><?=$i->banyak?></td> 
		                                    </tr>

		                                    <?php $no++;
		                                }


		                            ?>

			  					</tbody>
			  				</table>

			  			</td>
			  			
			  			
			  		</tr>
			  		<tr>
			  			<td></td>
			  			<td></td>
			  			<td></td>
			  		</tr>
			  	</table>	 
			  </div>
			</div>

		</div>
	</div>
</div><br>
<div class="container">
	<div class="row-mt-8">
		<a href="<?= base_url('user/transaksi'); ?>" class="btn btn-primary">kembali</a>
		<a href="javascript:printDiv('print');" class="fas fa-print">Print</a> 
	</div>
</div>



<textarea id="printing-css" style="display:none;">.no-print{display:none}</textarea>
<iframe id="printing-frame" name="print_frame" src="#" style="display:none;"></iframe>
<script type="text/javascript">
function printDiv(elementId) {
 var a = document.getElementById('printing-css').value;
 var b = document.getElementById(elementId).innerHTML;
 window.frames["print_frame"].document.title = document.title;
 window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
 window.frames["print_frame"].window.focus();
 window.frames["print_frame"].window.print();
}


</script>
