 <?php
    include 'proses/connect.php';
    date_default_timezone_set('Asia/Jakarta');
    $query = mysqli_query($conn, "SELECT tb_order.*,nama, SUM(harga * jumlah) AS harganya FROM tb_order
        LEFT JOIN user ON user.id = tb_order.pelayan
        LEFT JOIN list_order ON list_order.kode_order = tb_order.id_order  
        LEFT JOIN daftar_menu ON daftar_menu.id = list_order.menu   
        GROUP BY id_order");
    while ($record = mysqli_fetch_array($query)) {
        $result[] = $record;
    }

    // $select_kat_menu = mysqli_query($conn, "SELECT id_kat_menu,kategori_menu FROM kategori_menu");
    ?>

 <div class="col-lg-9 mt-2">
     <div class="card">
         <div class="card-header">
             Halaman Order
         </div>
         <div class="card-body">
             <div class="row">
                 <div class="col d-flex justify-content-end">
                     <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTambahUser">Tambah Order</button>
                 </div>
             </div>
             <!-- Modal Tambah order baru -->
             <div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="ModalTambahUser" aria-hidden="true">
                 <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Order Makanan Dan Minuman</h1>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                         <div class="modal-body">
                             <form action="proses/proses_input_order.php" method="POST" class="needs-validation" novalidate>
                                 <div class="row">
                                     <div class="col-lg-3">
                                         <div class="input form-floating mb-3">
                                             <input type="text" class="form-control" id="uploadfoto" name="kode_order" value="<?php echo date('ymdHi') . rand(100, 999) ?>" readonly>
                                             <label for="kode_order">Kode Order</label>
                                             <div class="invalid-feedback">
                                                 Masukkan Kode Order
                                             </div>
                                         </div>
                                     </div>
                                     <div class="col-lg-2">
                                         <div class="form-floating mb-3">
                                             <input type="number" class="form-control" id="floatingInput" placeholder="Nomor Meja" name="meja" required>
                                             <label for="meja">Meja</label>
                                             <div class="invalid-feedback">
                                                 Masukkan Meja
                                             </div>
                                         </div>
                                     </div>
                                     <div class="col-lg-7">
                                         <div class="form-floating mb-3">
                                             <input type="text" class="form-control" id="floatingInput" placeholder="Nama Pelanggan" name="pelanggan" required>
                                             <label for="pelanggan">Nama Pelanggan</label>
                                             <div class="invalid-feedback">
                                                 Masukkan Nama Pelanggan
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-lg12">
                                         <div class="form-floating mb-3">
                                             <input type="text" class="form-control" id="catatan" placeholder="Catatan" name="catatan">
                                             <label for="catatan">Catatan</label>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="modal-footer">
                                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                     <button type="submit" class="btn btn-primary" name="input_order_validate" value="12345">Buat Order</button>
                                 </div>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- akhir modal tambah order baru -->
             <?php
                if (empty($result)) {
                    echo "Data Order Tidak Ada";
                } else {
                    foreach ($result as $row) {
                ?>
                     <!-- Modal edit menu -->
                     <div class="modal fade" id="ModalEdit<?php echo $row['id_order'] ?>" tabindex="-1" aria-labelledby="ModalEdit" aria-hidden="true">
                         <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu Makanan Dan Minuman</h1>
                                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                     <form action="proses/proses_edit_order.php" method="POST" class="needs-validation" novalidate>
                                         <div class="row">
                                             <div class="col-lg-3">
                                                 <div class="input form-floating mb-3">
                                                     <input readonly type="text" class="form-control" id="uploadfoto" name="kode_order" value="<?php echo $row['id_order'] ?>">
                                                     <label for="kode_order">Kode Order</label>
                                                     <div class="invalid-feedback">
                                                         Masukkan Kode Order
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="col-lg-2">
                                                 <div class="form-floating mb-3">
                                                     <input type="number" class="form-control" id="floatingInput" placeholder="Nomor Meja" name="meja" required value="<?php echo $row['meja'] ?>">
                                                     <label for="meja">Meja</label>
                                                     <div class="invalid-feedback">
                                                         Masukkan Meja
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="col-lg-7">
                                                 <div class="form-floating mb-3">
                                                     <input type="text" class="form-control" id="floatingInput" placeholder="Nama Pelanggan" name="pelanggan" required value="<?php echo $row['pelanggan'] ?>">
                                                     <label for="pelanggan">Nama Pelanggan</label>
                                                     <div class="invalid-feedback">
                                                         Masukkan Nama Pelanggan
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="row">
                                             <div class="col-lg12">
                                                 <div class="form-floating mb-3">
                                                     <input type="text" class="form-control" id="catatan" placeholder="Catatan" name="catatan" value="<?php echo $row['catatan'] ?>">
                                                     <label for="catatan">Catatan</label>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                             <button type="submit" class="btn btn-primary" name="edit_order_validate" value="12345">Simpan</button>
                                         </div>
                                     </form>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <!-- akhir modal edit menu -->

                     <!-- Modal Delete-->
                     <div class="modal fade" id="ModalDelet<?php echo $row['id_order'] ?>" tabindex="-1" aria-labelledby="ModalDelet" aria-hidden="true">
                         <div class="modal-dialog modal-md modal-fullscreen-md-down">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Data Order</h1>
                                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                     <form action="proses/proses_delete_order.php" method="POST" class="needs-validation" novalidate>
                                         <input type="hidden" value="<?php echo $row['id_order'] ?>" name="kode_order">
                                         <div class="col-lg-12">
                                             Apakah anda ingin menghapus order <b><?php echo $row['pelanggan'] ?></b> dengan kode order <b><?php echo $row['id_order'] ?></b>
                                         </div>
                                         <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                             <button type="submit" class="btn btn-danger" name="delete_order_validate" value="12345">Hapus</button>
                                         </div>
                                     </form>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <!-- Akhir Modal Delete-->
                 <?php
                    }
                    ?>
                 <div class="table-responsive">
                     <table class="table table-hover">
                         <thead>
                             <tr class="text-nowrap">
                                 <th scope="col">No</th>
                                 <th scope="col">Kode Order</th>
                                 <th scope="col">Pelanggan</th>
                                 <th scope="col">Meja</th>
                                 <th scope="col">Total Harga</th>
                                 <th scope="col">Pelayan</th>
                                 <th scope="col">Status</th>
                                 <th scope="col">Waktu Order</th>
                                 <th scope="col">Aksi</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php
                                $no = 1;
                                foreach ($result as $row) {
                                ?>
                                 <tr>
                                     <th scope="row"><?php echo $no++ ?></th>
                                     <td><?php echo $row['id_order'] ?></td>
                                     <td><?php echo $row['pelanggan'] ?></td>
                                     <td><?php echo $row['meja'] ?></td>
                                     <td><?php echo number_format((int)$row['harganya'],0,',','.') ?></td>
                                     <td><?php echo $row['nama'] ?></td>
                                     <td><?php echo $row['status'] ?></td>
                                     <td><?php echo $row['waktu_order'] ?></td>
                                     <td>
                                         <div class="d-flex">
                                             <a class="btn btn-info btn-sm me-1" href="./?x=orderitem&order=<?php echo $row['id_order'] . "&meja=" . $row['meja'] . "&pelanggan=" . $row['pelanggan'] ?>"><i class="bi bi-eye"></i></a>
                                             <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id_order'] ?>"><i class="bi bi-pencil-square"></i></button>
                                             <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalDelet<?php echo $row['id_order'] ?>"><i class="bi bi-trash"></i></button>
                                         </div>
                                     </td>
                                 </tr>
                             <?php } ?>
                         </tbody>
                     </table>
                 </div>
             <?php } ?>
         </div>
     </div>

 </div>