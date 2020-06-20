

   

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


          <div class="row">
          	<div class="col-lg-6">
              <?php if (validation_errors()) : ?>
              <div class="alert alert-danger" role="alert">
                  <?= validation_errors(); ?>
              </div>
              <?php endif; ?>

          		<?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>


          		<?= $this->session->flashdata('message'); ?>
          		
          		<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newPakaianModal">Tambah</a>

              <!-- <div class="row mt-3">
                <div class="col-md-6">
                  <form action="" method="post">
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="Cari data pakaian.." name="keyword">
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Cari</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div> -->

				<table class="table table-hover">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Jenis Pakaian</th>
              <th scope="col">Action</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php $i = 1; ?>
				  	<?php foreach ($pakaian as $pkt) : ?> 
				    <tr>
				      <th scope="row"><?= $i; ?></th>
				      <td><?= $pkt['nama_pakaian']; ?></td>
				      <td>
                  <!-- <a href="<?= base_url('admin/roleaccess/') . $r['id'];?>" class="badge badge-warning">access</a> -->
				      		<a href="<?= base_url('admin/ubahPakaian/') . $pkt['id_pakaian']; ?>" class="fas fa-fw fa-edit"></a>
				      		<a href="<?= base_url('admin/hapusPakaian/') . $pkt['id_pakaian']; ?>" class="fas fa-fw fa-trash-alt"></a>
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
<div class="modal fade" id="newPakaianModal" tabindex="-1" role="dialog" aria-labelledby="newPakaianModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newPakaianModalLabel">Tambah Jenis Pakaian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('admin/pakaian'); ?>" method="post">
      <div class="modal-body">
        	<div class="form-group">
			    <input type="text" class="form-control" id="pakaian" name="pakaian" placeholder="Masukkan nama pakaian..">
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

     
