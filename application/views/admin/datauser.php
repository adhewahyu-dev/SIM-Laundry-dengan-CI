

   

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
          		
          		<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newUserModal">Tambah</a>

				<table class="table table-hover">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Nama</th>
              <th scope="col">Role</th>
              <th scope="col">Tgl Register</th>
				      <th scope="col">Action</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php $i = 1; ?>
				  	<?php foreach ($dataUser as $du) : ?> 
				    <tr>
				      <th scope="row"><?= $i; ?></th>
				      <td><?= $du['name']; ?></td>
              <td><?= $du['role']; ?></td>
              <td><?= date('d F Y', $user['date_created']); ?></td>
				      <td>
                  <!--<a href="<?= base_url('admin/roleaccess/') . $r['id'];?>" class="badge badge-warning">access</a>-->
				      		<a href="<?= base_url('admin/hapus/') . $du['id']; ?>" class="fas fa-fw fa-trash-alt"></a>
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
<div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newUserModalLabel">Tambah data user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('admin/datauser'); ?>" method="post">
      <div class="modal-body">
        	<div class="form-group">
			    <input type="text" class="form-control" id="name" name="name" placeholder="Nama">
			    </div>
          <div class="form-group">
          <input type="text" class="form-control" id="username" name="username" placeholder="Username">
          </div>
          <div class="form-group">
          <input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
          </div>
          <div class="form-group">
          <input type="password" class="form-control" id="password2" name="password2" placeholder="Ulangi Password">
          <br>
          <div class="form-group">
              <select name="role_id" id="role_id" class="form-control">
                  <option value="">Pilih Role</option>
                  <?php foreach($datauser as $daus ) : ?>
                  <option value="<?= $daus['id']; ?>"><?= $daus['role']; ?></option>
                  <?php endforeach; ?>
              </select>
          </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Add</button>
      </div>
      </form>
    </div>
  </div>
</div>

     
