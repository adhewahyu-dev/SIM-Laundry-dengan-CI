

   

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1><!-- 
 -->

          <div class="row">
          	<div class="col-lg-10">
              <?php if (validation_errors()) : ?>
              <div class="alert alert-danger" role="alert">
                  <?= validation_errors(); ?>
              </div>
              <?php endif; ?>
          		<?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>


          		<?= $this->session->flashdata('message'); ?>
          		
          		<a href="<?= base_url('user/tambahpelanggan'); ?>" class="btn btn-primary mb-3">Tambah</a>



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
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Nama</th>
              <th scope="col">Alamat</th>
              <th scope="col">Jenis Kelamin</th>
              <th scope="col">No Telepon</th>
              <th scope="col">Username</th>
				      <th scope="col">Action</th>
				    </tr>
				  </thead>
          <?php if( empty($pelanggan) ) : ?>
          <div class="alert alert-danger" role="alert">
          Data pelanggan tidak ditemukan..
          </div>
          <?php endif; ?>
				  <tbody>
				  	<?php $i = 1; ?>
				  	<?php foreach ($pelanggan as $p) : ?> 
				    <tr>
				      <th scope="row"><?= $i; ?></th>
				      <td><?= $p['nama']; ?></td>
		              <td><?= $p['alamat']; ?></td>
		              <td>
                    <?php if($p['jenis_kelamin'] == 'L') {?>
                    Laki-laki
                    <?php }else{?>
                    Perempuan
                    <?php }?>  
                  </td>
                  <td><?= $p['telepon']; ?></td>
                  <td><?= $p['username']; ?></td>
				      <td>
                  <!--<a href="<?= base_url('admin/roleaccess/') . $r['id'];?>" class="badge badge-warning">access</a>-->
				      		<a href="<?= base_url('user/ubahPelanggan/') . $p['id']; ?>" class="badge badge-success">edit</a>
                  <a href="<?= base_url('user/hapusPelanggan/') . $p['id']; ?>" class="badge badge-danger">delete</a>
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
<div class="modal fade" id="newPelangganModal" tabindex="-1" role="dialog" aria-labelledby="newPelangganModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newPelangganModalLabel">Tambah data pelanggan</h5>
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

     
