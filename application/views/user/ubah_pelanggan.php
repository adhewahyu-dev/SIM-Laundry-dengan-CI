

   

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          
          <div class="row">
          	<div class="col-lg-8">
          		
          	 <!--<?= form_open_multipart('user/ubahPelanggan');?> -->
          		<form action="" method="post">	
          		<div class="form-group row">
          			<label for="nama" class="col-sm-2 col-form-label">Nama</label>
          			<div class="col-sm-10">
          				<input type="text" class="form-control" id="nama" name="nama" value="<?= $pelanggan['nama'];?>">
                  <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                  <input type="text" class="form-control" id="id" name="id" value="<?= $pelanggan['id'];?>" hidden>
          			</div>
          		</div>
          		<div class="form-group row">
          			<label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
          			<div class="col-sm-10">
          				<input type="text" class="form-control" id="alamat" name="alamat" value="<?= $pelanggan['alamat'];?>">
          				<?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
          			</div>
          		</div>

              <div class="form-group row">
                <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-3">
                  <input type="radio" id="jk" name="jk" value="L" <?php if($pelanggan['jenis_kelamin'] == 'L'){echo 'checked';} ?>> Laki-laki
                  <input type="radio" id="jk" name="jk" value="P" <?php if($pelanggan['jenis_kelamin'] == 'P'){echo 'checked';} ?>> Perempuan
                  <?= form_error('jk', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
              </div>

              <div class="form-group row">
                <label for="telepon" class="col-sm-2 col-form-label">No Telepon</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="telepon" name="telepon" value="<?= $pelanggan['telepon'];?>">
                  <?= form_error('telepon', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
              </div>
              <div class="form-group row">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="username" name="username" value="<?= $pelanggan['username'];?>">
                  <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
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

     
