

   

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          
          <div class="row">
          	<div class="col-lg-8">
          		
          	 <!--<?= form_open_multipart('user/ubahPelanggan');?> -->
          		<form action="" method="post">	
          		<div class="form-group row">
          			
          			<div class="col-sm-10">
          				<input type="text" class="form-control" id="tgl" name="tgl" value="<?= $transaksi['tgl_masuk'];?>" hidden>
                  <input type="text" class="form-control" id="no_transaksi" name="no_transaksi" value="<?= $transaksi['id_orders'];?>" hidden>
                  <input type="text" class="form-control" id="pelanggan" name="pelanggan" value="<?= $transaksi['pelanggan'];?>" hidden>
                  <input type="text" class="form-control" id="penerima" name="penerima" value="<?= $transaksi['penerima'];?>" hidden>
                  <input type="text" class="form-control" id="paket" name="paket" value="<?= $transaksi['paket'];?>" hidden>
                  <input type="text" class="form-control" id="harga" name="harga" value="<?= $transaksi['harga'];?>" hidden>
                  <input type="text" class="form-control" id="berat" name="berat" value="<?= $transaksi['berat'];?>" hidden>
                  <input type="text" class="form-control" id="total" name="total" value="<?= $transaksi['total'];?>" hidden>
                  <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
          			</div>
          		</div>
          		<div class="form-group row">
          			<label for="alamat" class="col-sm-2 col-form-label">Alasan Pembatalan</label>
          			<div class="col-sm-10">
          				<input type="text" class="form-control" id="keterangan" name="keterangan">
          				<?= form_error('keterangan', '<small class="text-danger pl-3">', '</small>'); ?>
          			</div>
          		</div>


          	</div>
          </div>

          		<div class="form-group row justify-content-end">
          			<div class="col-sm-10">
          				<button type="submit" class="btn btn-primary" name="ubah">Edit</button>
          			</div>
          		</div>
          		</form>

          	</div>
          </div>



        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

     
