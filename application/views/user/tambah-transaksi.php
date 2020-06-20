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
 <!-- AWAL MAIN-->
 
        <!-- Breadcrumb-->
        
        <div class="container-fluid">
          <div class="animated fadeIn">
              <div class="row">
                <div class="col-sm-4">
                <div class="row">
                 
            <!-- Awal Tempat transksi-->
            <?php
            foreach($tmasakan->result_object() as $tm){
            ?>
               <!-- Awal Tempat Masak--> 
         
              <div class="card" style="width: 9rem;">
                <div class="card-body" align="center">
                  <h5 class="card-title" align="center"><?php echo $tm->nama_pakaian; ?></h5>
                  
                  <button class="tambah_beli btn btn-primary"
                  data-idmasakan="<?php echo $tm->id_pakaian;?>"
                  data-namamasakan="<?php echo $tm->nama_pakaian;?>"
                  >tambah</button>
                </div>
              </div>
              <!-- Akhir Tempat Masak-->
              <?php
            } 
            ?>
            </div>
                </div> 
                <div class="col-sm-6">
                   <!-- Awal Keranjang-->
                   <?php echo form_open('user/simpantransaksi'); ?>
           

              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header">
                  <div class="row">
                <div class="col-sm-12">

                      <?php if($this->session->flashdata('info')){?>
                          <div class="alert alert-warning" role="alert">
                              <?php echo $this->session->flashdata('info') ?>
                        </div>
                      <?php } ?>

              
              <form action="" method="post"> 
            
              <div class="form-group">
                  <label for="name"><b>No Transaksi</b></label>
                  <?php echo form_input('no_orders',$orders, array('class'=>'form-control', 'placeholder'=>'Isi Invoice ','readOnly'=>'readOnly')); ?>
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
                <label for="name" class="col-sm-3 col-form-label">Nama Penerima</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="penerima" name="penerima">
                  <?= form_error('penerima', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
              </div>
              <!-- <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['name']; ?></span> -->
              <div class="form-group row">
                <label for="paket_id" class="col-sm-3 col-form-label">Paket</label>
               <select name="paket_id" id="paket_id" class="form-control col-sm-5" onchange="changeValue(this.value)" >
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
            </form>

                <div class="col-sm-12">
                    <i class="fa fa-align-justify"></i> <h4>Detail Pakaian</h4></div>
                  <div class="card-body">
                    <table class="table table-responsive-sm table-striped">
                      <thead>
                        <tr>
                          <th>Nama Pakaian</th>
                          <th>Jumlah</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody id="tampil_keranjang">
                        
                      </tbody>
                    </table>
                    <?php echo form_submit('btnsimpan','SIMPAN',array('class' =>'btn btn-danger'));?>
                  </div>
                </div>
              </div>
              <!-- Akhir Keranjang--> 
            <!-- Akhir Tempat transaksi--> 

                </div>  
              </div>
          </div>
        </div>
      </main>
        <!-- AKHIR MAIN-->

<?php $this->load->view('templates/footer2'); ?>
<script type="text/javascript" src="<?php echo base_url('asset/js/jquery-2.2.3.min.js');?>">
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.tambah_beli').click(function(){
      var masakan_id    = $(this).data("idmasakan");
      var masakan_nama  = $(this).data("namamasakan");
      $.ajax({
        url : "<?php echo base_url();?>user/simpan_keranjang",
        method : "POST",
        data : {id: masakan_id, nama_pakaian: masakan_nama},
        success: function(data){
          $('#tampil_keranjang').html(data);
        }
      });
    });

    // panggil data tampil keranjang
    $('#tampil_keranjang').load("<?php echo base_url();?>user/load_keranjang");
  });
  $(document).on('click','.hapus_cart',function(){
      var row_id=$(this).attr("id"); //mengambil row_id dari artibut id
      $.ajax({
        url : "<?php echo base_url();?>user/hapus_cart",
        method : "POST",
        data : {row_id : row_id},
        success :function(data){
          $('#tampil_keranjang').html(data);
        }
      });
    });


</script>
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
