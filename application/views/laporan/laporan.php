

<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1><!-- 
 -->

          <div class="row">
            <form action="<?=base_url('admin/laporan');?>" method="post">
                Tanggal Awal <input type="date" name="tgl_awal" id="" style="display: inline-block; width: 150px;" class="form-control form-control-sm"> 
                sampai Tanggal Akhir <input style="display: inline-block; width: 150px;" type="date" name="tgl_akhir" class="form-control form-control-sm" id=""> <br><br>
                <button type="submit" class="btn btn-primary btn-sm">C e k </button> <br>
                <a href="javascript:printDiv('print');" class="fas fa-print">Print</a>  
            </form>
            
<div id="print">
            <div class="col-lg">
                <div class="text-center">
                <?php error_reporting(0); if($tgl_awal == '' && $tgl_akhir == ''){
                    ?>
                        <h4><b>Laporan</b></h4>
                    <?php
                }else{
                    ?>
                        <h4><b><?=mediumdate_indo($tgl_awal)?>  &nbsp;SAMPAI DENGAN&nbsp;  <?= mediumdate_indo($tgl_akhir)?></b></h4>
                    <?php
                } ?>
            </div>

                <table class="table" border="0">
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Tgl Masuk</th>
                            <th>No Transaksi</th>
                            <th>Nama Pelanggan</th>
                            <th>Paket</th>
                            <th>Harga /kg</th>
                            <th>Berat /kg</th>
                            <th>Tgl Ambil</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total=0; ?>
                        <?php $i = 1; ?>
                        <?php foreach ($transaksi as $tr) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= mediumdate_indo($tr['tgl_masuk']); ?></td>
                            <td><?= $tr['id_orders'] ?></td>
                            <td><?= $tr['pelanggan'] ?></td>
                            <td><?= $tr['paket'] ?></td>
                            <td><?= number_format($tr['harga']); ?></td>
                            <td><?= $tr['berat'] ?></td>
                            <td><?= mediumdate_indo($tr['tgl_ambil']); ?></td>
                            <td><?= number_format($tr['total']); ?></td>
                        </tr>
                        <?php $total += $tr['total'];?> 
                        <?php $i++; ?>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="8" align="center"> TOTAL</td>
                            <td><?= number_format($total, 0, ',', '.'); ?></td>
                        </tr> 
                       <!--  <tr align="center">
                            <td>#</td>
                            <td colspan="4">Keterangan Belanja</td>
                            <td colspan="3">Tanggal Belanja</td>
                            <td>Nominal</td>
                        </tr>
                        <?php $i = 1; ?>
                        <?php foreach ($pengeluaran as $peng) : ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td colspan="4"><?= $peng['ket']; ?></td>
                            <td colspan="3"><?= $peng['tanggal']; ?></td>
                            <td><?= $peng['nominal']; ?></td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="8" align="center"> TOTAL</td>
                            <td><?= number_format($total, 0, ',', '.'); ?></td>
                        </tr> --> 
                    </tbody>
                </table>


            </div>
</div>
          </div>
</div>


<textarea id="printing-css" style="display:none;">.no-print{display:none}</textarea>
<iframe id="printing-frame" name="print_frame" src="#" style="display:none;"></iframe>
<script type="text/javascript">
function printDiv(elementId) {
 var a = document.getElementById('printing-css').value;
 var b = document.getElementById(elementId).innerHTML;
 window.frames["print_frame"].document.title = document.title;
 window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
 window.frames["print_frame"].window.focus();
 window.frames["print_frame"].window.print();
}


</script>