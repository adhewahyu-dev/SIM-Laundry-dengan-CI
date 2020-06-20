
   

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1><!-- 
 -->

          <div class="row">
          	<div class="col-lg">
              <?php if (validation_errors()) : ?>
              <div class="alert alert-danger" role="alert">
                  <?= validation_errors(); ?>
              </div>
              <?php endif; ?>
          		<?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>


          		<?= $this->session->flashdata('message'); ?>
          		
          		<a href="<?= base_url('user/tambahtransaksi'); ?>" class="btn btn-primary mb-3">Tambah</a>



              <div class="row mt-3">
                <div class="col-md-6">
                  <form action="" method="post">
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="Cari data pelanggan.." name="keyword">
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Cari</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>


				<table class="table table-hover">
				  <thead>
				    <tr align="center">
				      <th scope="col">#</th>
				      <th scope="col">Tanggal Masuk</th>
              <th scope="col">No Transaksi</th>
              <th scope="col">Nama Pelanggan</th>
              <th scope="col">Penerima</th>
              <th scope="col">Paket</th>
              <th scope="col">Harga /kg</th>
              <th scope="col">Berat /kg</th>
              <th scope="col">Total</th>
              <th scope="col">Tanggal Ambil</th>
              <th scope="col">Status</th>
				      <th scope="col">Action</th>
				    </tr>
				  </thead>
          <?php if( empty($transaksi) ) : ?>
          <div class="alert alert-danger" role="alert">
          Data pelanggan tidak ditemukan..
          </div>
          <?php endif; ?>
				  <tbody>
				  	<?php $i = 1; ?>
				  	<?php foreach ($transaksi as $tr) : ?> 
				    <tr>
				      <th scope="row"><?= $i; ?></th>
				      <td><?= mediumdate_indo($tr['tgl_masuk']); ?></td>
		          <td><?= $tr['id_orders']; ?></td>
		          <td><?= $tr['pelanggan']; ?></td>
              <td><?= $tr['penerima'];?></td>
              <td><?= $tr['paket']; ?></td>
              <td><?= number_format($tr['harga']); ?> </td>
              <td><?= $tr['berat']; ?> </td>
              <td><?= number_format($tr['total']); ?></td>
             
              <!-- <td><?= $tr['tgl']; ?></td> -->
              <td><?= mediumdate_indo($tr['tgl_ambil']); ?></td>
              <td>
                <input type="" name="id" value="<?= $tr['id']; ?>" hidden>
                <?php if( $tr['status']==0 ){ ?>
                  <a href="<?= base_url('user/editTransaksi/') . $tr['id']; ?>"  class="btn btn-primary btn-sm" onclick="return confirm('apakah pakaian benar-benar sudah SELESAI dicuci?');">proses</a>
                <?php }elseif ( $tr['status']==1 ) { ?>  
                  <a href="<?= base_url('user/editTransaksii/') . $tr['id']; ?>"  class="btn btn-warning btn-sm" onclick="return confirm('apakah pakaian benar-benar DIAMBIL?');">selesai</a>
                <?php }else{ ?>
                  <a href="#"  class="btn btn-success btn-sm">diambil</a>
                <?php } ?>
                <!-- <?= $tr['status']; ?> --></td>
				      <td>
                <?php if( $tr['status']==0 ){ ?>
                  <!--<a href="<?= base_url('admin/roleaccess/') . $r['id'];?>" class="badge badge-warning">access</a>-->
				      		<!-- <a href="<?= base_url('user/editTransaksi/') . $tr['id']; ?>" class="badge badge-success">edit</a> -->
                  <a href="<?= base_url('user/cetak/') . $tr['id']; ?>"  class="fas fa-fw fa-print"></a>
                  <a href="<?= base_url('user/hapusTransaksi/') . $tr['id']; ?>"  class="fas fa-fw fa-trash-alt" onclick="return confirm('Apakah transaksi ini benar dibatalkan?');"></a>
                <?php } elseif ( $tr['status']==1 ) { ?>
--
                <?php }else{ ?>
                  <a href="<?= base_url('user/cetakpembayaran/') . $tr['id']; ?>"  class="fas fa-fw fa-print"></a>
                <?php } ?>
              </td>
				    </tr>
				    <?php $i++; ?>
					<?php endforeach; ?>
				  </tbody>
				</table>
          	</div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->


      <!-- MODAL -->
      <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="printTransaksiModal" tabindex="-1" role="dialog" aria-labelledby="printTransaksiModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="printTransaksiModalLabel">Tambah data pelanggan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('user/pelanggan'); ?>" method="post">
      <div class="modal-body">
        		  <div class="form-group">
				  <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama pelanggan..">
				  </div>
		          <div class="form-group">
		          <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat pelanggan..">
		          </div>
		          <div class="form-group">
		          <input type="number" class="form-control" id="telepon" name="telepon" placeholder="Nomor telepon pelanggan..">
		          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>


     
