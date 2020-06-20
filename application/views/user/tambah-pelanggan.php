

   

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
          				<input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama'); ?>">
                  		<?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
          			</div>
          		</div>
          		<div class="form-group row">
          			<label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
          			<div class="col-sm-10">
          				<input type="text" class="form-control" id="alamat" name="alamat" value="<?= set_value('alamat'); ?>">
          				<?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
          			</div>
          		</div>
              <div class="form-group row">
                <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-3">
                  <input type="radio" id="jk" name="jk" value="L"> Laki-laki
                  <input type="radio" id="jk" name="jk" value="P"> Perempuan
                  <?= form_error('jk', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
              </div>
              <div class="form-group row">
                <label for="telepon" class="col-sm-2 col-form-label">No Telepon</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="telepon" name="telepon" value="<?= set_value('telepon'); ?>">
                      <?= form_error('telepon', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
              </div>
              <div class="form-group row">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="username" name="username" value="<?= set_value('username'); ?>">
                      <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
              </div>
                <div class="form-group row">
                <label for="password1" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="password1" name="password1">
                      <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
              </div>
                <div class="form-group row">
                <label for="password2" class="col-sm-2 col-form-label">Ulangi Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="password2" name="password2">
                  
                </div>
              </div>


          	</div>
          </div>

          		<div class="form-group row justify-content-end">
          			<div class="col-sm-10">
          				<button type="submit" class="btn btn-primary" name="ubah">Tambah</button>
          			</div>
          		</div>
          		</form>

          	</div>
          </div>



        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

     
