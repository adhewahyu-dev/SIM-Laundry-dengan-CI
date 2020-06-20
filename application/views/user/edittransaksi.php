<?php
$servername="localhost";
$user="root";
$pass="";
$db="wpu_login";

$connection= mysqli_connect($servername, $user, $pass, $db);

if(!$connection){
  die ("Connection failed: ".mysqli_connect_error());
}

$barang=mysqli_query($connection, "SELECT * FROM paket");
$jsArray = "var hrg_brg = new Array();\n"; 

?>    

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          
          <div class="row">
          	<div class="col-lg-8">
          		
          	 <!--<?= form_open_multipart('user/ubahPelanggan');?> -->
          		<form action="" method="post">	
          		<div class="form-group row">
          			<label for="no-transaksi" class="col-sm-3 col-form-label">No Transaksi</label>
          			<div class="col-sm-4">
          				<input type="text" class="form-control" id="no_transaksi" name="no_transaksi" value="<?= $transaksi['no']; ?>" readonly>
                  		<?= form_error('no_transaksi', '<small class="text-danger pl-3">', '</small>'); ?>
          			</div>
          		</div>
          		<div class="form-group row">
          			<label for="pelanggan_id" class="col-sm-3 col-form-label">Nama Pelanggan</label> 
          			<!-- <div class="col-sm-5> -->
          				<select name="pelanggan_id" id="pelanggan_id" class="form-control col-sm-5 selectpicker" data-live-search="true">
                <label for="nama_id" class="col-sm-3 col-form-label">Nama Pelanggan</label>
                  <option value="">Pilih Nama Pelanggan</option>
                  <?php foreach($pelanggan as $tr ) : ?>
                  <option value="<?= $tr['nama']; ?>"><?= $tr['nama']; ?></option>
                  <?php endforeach; ?>
              </select> &nbsp &nbsp
                  <a href="<?= base_url('user/tambahpelanggan'); ?>" class="badge badge-success">Tambah data<br>pelanggan</a>
          				<?= form_error('pelanggan_id', '<small class="text-danger pl-3">', '</small>'); ?>
          			<!-- </div> -->
          		</div>



              <div class="form-group row">
                <label for="paket_id" class="col-sm-3 col-form-label">Paket</label>
               <select name="paket_id" id="paket_id" class="form-control col-sm-3" onchange="changeValue(this.value)" >
                <option>- Pilih Paket Layanan -</option>
                <?php if(mysqli_num_rows($barang)) {?>
                    <?php while($trans= mysqli_fetch_array($barang)) {?>
                        <option value="<?php echo $trans["paket"]?>"> <?php echo $trans["paket"]?> </option>
                    <?php $jsArray .= "hrg_brg['" . $trans['paket'] . "'] = {hrg:'" . addslashes($trans['harga']) . "'};\n"; } ?>
                <?php } ?>
              </select>
              <?= form_error('paket_id', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="form-group row">
                <label for="hrg" class="col-sm-3 col-form-label">Harga</label>
                <div class="col-sm-3">
                  <input type="number" class="form-control" id="hrg" name="hrg" onkeyup="sum();" readonly>
                  <?= form_error('hrg', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
              </div>


          <!--     <div class="form-group row">
                <label for="paket" class="col-sm-3 col-form-label">Paket</label>
               <select name="paket" id="paket" class="form-control col-sm-3">
                  <option value="">Pilih Paket Layanan</option>
                  <?php foreach($transaksi as $trans ) : ?>
                  <option value="<?= $trans['id']; ?>"><?= $trans['paket']; ?></option>
                  <?php endforeach?>
              </select>
              </div>
              <div class="form-group row">
                <label for="harga" class="col-sm-3 col-form-label">Harga</label>
                <div class="col-sm-3">
                  <input type="number" class="form-control" id="harga" name="harga">
                  <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
              </div> -->
              <div class="form-group row">
                <label for="telepon" class="col-sm-3 col-form-label">Berat /kg</label>
                <div class="col-sm-3">
                  <input type="number" class="form-control" id="berat" name="berat" onkeyup="sum();">
                </div> 
              </div>
              <?= form_error('berat', '<small class="text-danger pl-3">', '</small>'); ?>
              <div class="form-group row">
                <label for="total" class="col-sm-3 col-form-label">Total</label>
                <div class="col-sm-3">
                  <input type="number" class="form-control" id="total" name="total" readonly>
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
      
<script type="text/javascript">
    <?php echo $jsArray; ?>
    function changeValue(paket_id) {
      document.getElementById("hrg").value = hrg_brg[paket_id].hrg;
    };


    function sum() {
        var txtFirstNumberValue = document.getElementById('hrg').value;
        var txtSecondNumberValue = document.getElementById('berat').value;
        var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
        if(!isNaN(result)){
          document.getElementById('total').value = result;
        }
    }
</script> <!-- Tampilkan Harga berdasarkan kode barang -->
     
