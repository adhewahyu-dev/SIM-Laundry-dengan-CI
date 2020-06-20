

   

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1><!-- 
 -->

          <div class="row">
          	<div class="col-lg-6">
              <?php if (validation_errors()) : ?>
              <div class="alert alert-danger" role="alert">
                  <?= validation_errors(); ?>
              </div>
              <?php endif; ?>

          		<?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>


          		<?= $this->session->flashdata('message'); ?>
          		
          		<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newPaketModal">Tambah</a>

				<table class="table table-hover">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Jenis Paket</th>
				      <th scope="col">Harga</th>
              <th scope="col">Action</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php $i = 1; ?>
				  	<?php foreach ($paket as $pkt) : ?> 
				    <tr>
				      <th scope="row"><?= $i; ?></th>
				      <td><?= $pkt['paket']; ?></td>
              <td><?= "Rp. " . number_format($pkt['harga']); ?></td>
				      <td>
                  <!-- <a href="<?= base_url('admin/roleaccess/') . $r['id'];?>" class="badge badge-warning">access</a> -->
				      		<a href="<?= base_url('admin/ubahPaket/') . $pkt['id']; ?>" class="badge badge-success">edit</a>
				      		<a href="<?= base_url('admin/hapusPaket/') . $pkt['id']; ?>" class="badge badge-danger">delete</a>
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
<div class="modal fade" id="newPaketModal" tabindex="-1" role="dialog" aria-labelledby="newPaketModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newPaketModalLabel">Tambah Paket Layanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('admin/paket'); ?>" method="post">
      <div class="modal-body">
        	<div class="form-group">
			    <input type="text" class="form-control" id="paket" name="paket" placeholder="Masukkan nama paket..">
			    </div>
          <div class="form-group">
          <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan harga paket..">
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

     
