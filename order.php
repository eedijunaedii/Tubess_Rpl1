 <?php
    include 'proses/connect.php';
    date_default_timezone_set('Asia/Jakarta');
    $query = mysqli_query($conn, "SELECT tb_order.*,nama, SUM(harga * jumlah) AS harganya FROM tb_order
        LEFT JOIN user ON user.id = tb_order.pelayan
        LEFT JOIN list_order ON list_order.order = tb_order.id_order  
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
                                             <input type="text" class="form-control" id="uploadfoto" name="kode_order" value="<?php echo date('ymdHi').rand(100,999) ?>" readonly>
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
                     <!-- Modal view menu -->
                     <div class="modal fade" id="ModalView<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="ModalView" aria-hidden="true">
                         <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu Makanan Dan Minuman</h1>
                                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                     <form action="proses/proses_input_menu.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                         <div class="row">
                                             <div class="col-lg-12">
                                                 <div class="form-floating mb-3">
                                                     <input type="text" class="form-control" id="floatingInput" placeholder="nama_menu" name="nama_menu" value="<?php echo $row['nama_menu'] ?>" disabled>
                                                     <label for="floatingInput">Nama Menu</label>
                                                     <div class="invalid-feedback">
                                                         Masukkan Nama Menu
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="row">
                                             <div class="col-lg12">
                                                 <div class="form-floating mb-3">
                                                     <input type="text" class="form-control" id="floatingPassword" value="<?php echo $row['keterangan'] ?>" disabled>
                                                     <label for="floatingPassword">Keterangan</label>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="row">
                                             <div class="col-lg-4">
                                                 <div class="form-floating mb-3">
                                                     <select class="form-select" aria-label="Default select example" value="" disabled>
                                                         <option selected hidden value="">Pilih Kategori Menu</option>
                                                         <?php
                                                            foreach ($select_kat_menu as $value) {
                                                                if ($row['kategori'] == $value['id_kat_menu']) {
                                                                    echo "<option selected value=" . $value['id_kat_menu'] . ">$value[kategori_menu]</option>";
                                                                } else {
                                                                    echo "<option value=" . $value['id_kat_menu'] . ">$value[kategori_menu]</option>";
                                                                }
                                                            }
                                                            ?>
                                                     </select>
                                                     <label for="floatingInput">Kategori Makanan atau Minuman</label>
                                                     <div class="invalid-feedback">
                                                         Pilih Kategori Makanan atau Minuman
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="col-lg-4">
                                                 <div class="form-floating mb-3">
                                                     <input type="number" class="form-control" id="floatingInput" value="<?php echo $row['harga'] ?>" disabled>
                                                     <label for="floatingInput">Harga</label>
                                                     <div class="invalid-feedback">
                                                         Masukkan Harga Menu
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="col-lg-4">
                                                 <div class="form-floating mb-3">
                                                     <input type="number" class="form-control" id="floatingInput" value="<?php echo $row['stok'] ?>" disabled>
                                                     <label for="floatingInput">Stok</label>
                                                     <div class="invalid-feedback">
                                                         Masukkan Stok Menu
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                             <button type="submit" class="btn btn-primary" name="input_menu_validate" value="12345">Save changes</button>
                                         </div>
                                     </form>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <!-- akhir modal view menu -->

                     <!-- Modal edit menu -->
                     <div class="modal fade" id="ModalEdit<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="ModalEdit" aria-hidden="true">
                         <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu Makanan Dan Minuman</h1>
                                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                     <form action="proses/proses_edit_menu.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                         <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                         <div class="row">
                                             <div class="col-lg-6">
                                                 <div class="input-group mb-3">
                                                     <input type="file" class="form-control py-3" id="uploadfoto" placeholder="YourName" name="foto" required>
                                                     <label class="input-group-text" for="uploadfoto">Upload Foto Menu</label>
                                                     <div class="invalid-feedback">
                                                         Masukkan Foto Menu
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="col-lg-6">
                                                 <div class="form-floating mb-3">
                                                     <input type="text" class="form-control" id="floatingInput" placeholder="nama_menu" name="nama_menu" value="<?php echo $row['nama_menu'] ?>">
                                                     <label for="floatingInput">Nama Menu</label>
                                                     <div class="invalid-feedback">
                                                         Masukkan Nama Menu
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="row">
                                             <div class="col-lg12">
                                                 <div class="form-floating mb-3">
                                                     <input type="text" class="form-control" id="floatingPassword" placeholder="Keterangan" name="keterangan" value="<?php echo $row['keterangan'] ?>">
                                                     <label for="floatingPassword">Keterangan</label>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="row">
                                             <div class="col-lg-4">
                                                 <div class="form-floating mb-3">
                                                     <select class="form-select" aria-label="Default select example" value="" name="kat_menu">
                                                         <option selected hidden value="">Pilih Kategori Menu</option>
                                                         <?php
                                                            foreach ($select_kat_menu as $value) {
                                                                if ($row['kategori'] == $value['id_kat_menu']) {
                                                                    echo "<option selected value=" . $value['id_kat_menu'] . ">$value[kategori_menu]</option>";
                                                                } else {
                                                                    echo "<option value=" . $value['id_kat_menu'] . ">$value[kategori_menu]</option>";
                                                                }
                                                            }
                                                            ?>
                                                     </select>
                                                     <label for="floatingInput">Kategori Makanan atau Minuman</label>
                                                     <div class="invalid-feedback">
                                                         Pilih Kategori Makanan atau Minuman
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="col-lg-4">
                                                 <div class="form-floating mb-3">
                                                     <input type="number" class="form-control" id="floatingInput" placeholder="harga" name="harga" value="<?php echo $row['harga'] ?>" required>
                                                     <label for="floatingInput">Harga</label>
                                                     <div class="invalid-feedback">
                                                         Masukkan Harga Menu
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="col-lg-4">
                                                 <div class="form-floating mb-3">
                                                     <input type="number" class="form-control" id="floatingInput" placeholder="stok" name="stok" value="<?php echo $row['stok'] ?>" required>
                                                     <label for="floatingInput">Stok</label>
                                                     <div class="invalid-feedback">
                                                         Masukkan Stok Menu
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                             <button type="submit" class="btn btn-primary" name="input_menu_validate" value="12345">Save changes</button>
                                         </div>
                                     </form>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <!-- akhir modal edit menu -->

                     <!-- Modal Delete-->
                     <div class="modal fade" id="ModalDelet<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="ModalDelet" aria-hidden="true">
                         <div class="modal-dialog modal-md modal-fullscreen-md-down">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Data Menu</h1>
                                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                     <form action="proses/proses_delete_menu.php" method="POST" class="needs-validation" novalidate>
                                         <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                         <input type="hidden" value="<?php echo $row['foto'] ?>" name="foto">
                                         <div class="col-lg-12">
                                             Apakah anda ingin menghapus menu <b><?php echo $row['nama_menu'] ?></b>
                                         </div>
                                         <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                             <button type="submit" class="btn btn-danger" name="input_user_validate" value="12345">Hapus</button>
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
                                     <td><?php echo $row['meja']?></td>
                                     <td><?php echo $row['harganya']?></td>
                                     <td><?php echo $row['nama'] ?></td>
                                     <td><?php echo $row['status'] ?></td>
                                     <td><?php echo $row['waktu_order'] ?></td>
                                     <td>
                                         <div class="d-flex">
                                             <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalView<?php echo $row['id_order'] ?>"><i class="bi bi-eye"></i></button>
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