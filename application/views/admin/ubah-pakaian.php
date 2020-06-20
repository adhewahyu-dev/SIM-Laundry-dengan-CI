

   

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          
          <div class="row">
          	<div class="col-lg-8">
          		
          	<!-- <?= form_open_multipart('admin/ubahPakaian');?> -->
          		<form action="" method="post">	
          		<div class="form-group row">
          			<label for="email" class="col-sm-2 col-form-label">Pakaian</label>
          			<div class="col-sm-10">
          				<input type="text" class="form-control" id="pakaian" name="pakaian" value="<?= $pakaian['nama_pakaian'];?>">
                  <?= form_error('pakaian', '<small class="text-danger pl-3">', '</small>'); ?>
                  <input type="text" class="form-control" id="id" name="id" value="<?= $pakaian['id_pakaian'];?>" hidden>
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

     
