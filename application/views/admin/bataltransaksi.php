
   

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1><!-- 
 -->

          <div class="row">
          	<div class="col-lg">



              <div class="row mt-3">
                <div class="col-md-6">
                  <form action="" method="post">
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="Cari data pelanggan.." name="keyword">
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Cari</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>


				<table class="table table-hover">
				  <thead>
				    <tr align="center">
				      <th scope="col">#</th>
				      <th scope="col">Tanggal Masuk</th>
              <th scope="col">Tanggal Pembatalan</th>
              <th scope="col">No Transaksi</th>
              <th scope="col">Nama Pelanggan</th>
              <th scope="col">Penerima</th>
              <th scope="col">Paket</th>
              <th scope="col">Harga /kg</th>
              <th scope="col">Berat /kg</th>
              <th scope="col">Total</th>
              <th scope="col">Keterangan Batal</th>
				    </tr>
				  </thead>
          <?php if( empty($recovery) ) : ?>
          <div class="alert alert-danger" role="alert">
          Data pelanggan tidak ditemukan..
          </div>
          <?php endif; ?>
				  <tbody>
				  	<?php $i = 1; ?>
				  	<?php foreach ($recovery as $rec) : ?> 
				    <tr>
				      <th scope="row"><?= $i; ?></th>
				      <td><?= date('d-m-Y', $rec['tgl_masuk']); ?></td>
              <td><?= date('d-m-Y', $rec['tgl_masuk']); ?></td>
		          <td><?= $rec['no_transaksi']; ?></td>
		          <td><?= $rec['pelanggan']; ?></td>
              <td><?= $rec['penerima'];?></td>
              <td><?= $rec['paket']; ?></td>
              <td><?= number_format($rec['harga']); ?> </td>
              <td><?= $rec['berat']; ?> </td>
              <td><?= number_format($rec['total']); ?></td>
              <!-- <td><?= $tr['tgl']; ?></td> -->
              <td><?= $rec['keterangan']; ?></td>
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


     
