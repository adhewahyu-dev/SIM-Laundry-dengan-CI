

   

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1><!-- 
 -->

          <div class="row">
          	<div class="col-lg-8">
              <?php if (validation_errors()) : ?>
              <div class="alert alert-danger" role="alert">
                  <?= validation_errors(); ?>
              </div>
              <?php endif; ?>
          		<?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>


          		<?= $this->session->flashdata('message'); ?>
          		
          		<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newPengeluaranModal">Tambah</a>

				<table class="table table-hover">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Keterangan</th>
              <th scope="col">Nominal</th>
              <th scope="col">Tanggal</th>
				      <th scope="col">Action</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php $i = 1; ?>
				  	<?php foreach ($pengeluaran as $peng) : ?> 
				    <tr>
				      <th scope="row"><?= $i; ?></th>
				      <td><?= $peng['ket']; ?></td>
              <td><?= number_format($peng['nominal']); ?></td>
              <td><?= date('d F Y', $peng['tgl']); ?></td>
				      <td>
                  <!--<a href="<?= base_url('admin/roleaccess/') . $r['id'];?>" class="badge badge-warning">access</a>-->
				      		<a href="<?= base_url('admin/hapuspengeluaran/') . $peng['id']; ?>" class="badge badge-danger">delete</a>
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
<div class="modal fade" id="newPengeluaranModal" tabindex="-1" role="dialog" aria-labelledby="newPengeluaranModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newPengeluaranModalLabel">Tambah data user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('admin/pengeluaran'); ?>" method="post">
      <div class="modal-body">
        	<div class="form-group">
			    <input type="text" class="form-control" id="ket" name="ket" placeholder="Keterangan">
			    </div>
          <div class="form-group">
          <input type="text" class="form-control" id="nominal" name="nominal" placeholder="Nominal">
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

     
