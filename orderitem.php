 <?php
    include 'proses/connect.php';
    $query = mysqli_query($conn, "SELECT *, SUM(harga * jumlah) AS harganya FROM list_order
        LEFT JOIN tb_order ON tb_order.id_order = list_order.order  
        LEFT JOIN daftar_menu ON daftar_menu.id = list_order.menu   
        GROUP BY id_list_order
        HAVING list_order.order = $_GET[order]");
    $kode = $_GET['order'];
    $meja = $_GET['meja'];
    $pelanggan = $_GET['pelanggan'];

    while ($record = mysqli_fetch_array($query)) {
        $result[] = $record;
        // $kode = $record['id_order'];
        // $meja = $record['meja'];
        // $pelanggan = $record['pelanggan'];
    }

    // $select_kat_menu = mysqli_query($conn, "SELECT id_kat_menu,kategori_menu FROM kategori_menu");
    ?>

 <div class="col-lg-9 mt-2">
     <div class="card">
         <div class="card-header">
             Halaman Order Item
         </div>
         <div class="card-body">
             <div class="row">
                 <div class="col-lg-3">
                     <div class="form-floating mb-3">
                         <input disabled type="text" class="form-control" id="kodeorder" value="<?php echo $kode ?>">
                         <label for="uploadfoto">Kode Order</label>
                     </div>
                 </div>
                 <div class="col-lg-2">
                     <div class="form-floating mb-3">
                         <input disabled type="text" class="form-control" id="meja" value="<?php echo $meja ?>">
                         <label for="uploadfoto">Meja</label>
                     </div>
                 </div>
                 <div class="col-lg-3">
                     <div class="form-floating mb-3">
                         <input disabled type="text" class="form-control" id="pelanggan" value="<?php echo $pelanggan ?>">
                         <label for="uploadfoto">Pelanggan</label>
                     </div>
                 </div>
             </div>
         </div>
         <!-- Modal Tambah item -->
         <div class="modal fade" id="TambahItem" tabindex="-1" aria-labelledby="TambahItem" aria-hidden="true">
             <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu Makanan Dan Minuman</h1>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                         <form action="proses/proses_input_menu.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
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
                                         <input type="text" class="form-control" id="floatingInput" placeholder="nama_menu" name="nama_menu" required>
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
                                         <input type="text" class="form-control" id="floatingPassword" placeholder="Keterangan" name="keterangan">
                                         <label for="floatingPassword">Keterangan</label>
                                     </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-lg-4">
                                     <div class="form-floating mb-3">
                                         <select class="form-select" aria-label="Default select example" name="kat_menu" required>
                                             <option selected hidden value="">Pilih Kategori Menu</option>
                                             <?php
                                                foreach ($select_kat_menu as $value) {
                                                    echo "<option value=" . $value['id_kat_menu'] . ">$value[kategori_menu]</option>";
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
                                         <input type="number" class="form-control" id="floatingInput" placeholder="harga" name="harga" required>
                                         <label for="floatingInput">Harga</label>
                                         <div class="invalid-feedback">
                                             Masukkan Harga Menu
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-lg-4">
                                     <div class="form-floating mb-3">
                                         <input type="number" class="form-control" id="floatingInput" placeholder="stok" name="stok" required>
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
         <!-- akhir modal tambah item -->
         <?php
            if (empty($result)) {
                echo "Data Menu Makanan atau Minuman tidak ada";
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
                             <th scope="col">Menu</th>
                             <th scope="col">Harga</th>
                             <th scope="col">Jumlah</th>
                             <th scope="col">Total</th>
                             <th scope="col">Aksi</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                            $total = 0;
                            foreach ($result as $row) {
                            ?>
                             <tr>
                                 <td><?php echo $row['nama_menu'] ?></td>
                                 <td><?php echo number_format($row['harga'], 0, ',', '.')  ?></td>
                                 <td><?php echo $row['jumlah'] ?></td>
                                 <td><?php echo number_format($row['harganya'], 0, ',', '.')  ?></td>
                                 <td>
                                     <div class="d-flex">
                                         <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalView<?php echo $row['id_order'] ?>"><i class="bi bi-eye"></i></button>
                                         <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id_order'] ?>"><i class="bi bi-pencil-square"></i></button>
                                         <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalDelet<?php echo $row['id_order'] ?>"><i class="bi bi-trash"></i></button>
                                     </div>
                                 </td>
                             </tr>
                         <?php
                                $total += $row['harganya'];
                            } ?>
                         <tr>
                             <td colspan="3" class="fw-bold">
                                 Total Harga
                             </td>
                             <td class="fw-bold">
                                 <?php echo number_format($total, 0, ',', '.')  ?>
                             </td>
                         </tr>
                     </tbody>
                 </table>
             </div>
         <?php } ?>
         <div class="mb-2">
             <button class="btn btn-success btn-sm me-1" data-bs-toggle="modal" data-bs-target="#TambahItem"><i class="bi bi-plus-circle"></i> Item</button>
             <button class="btn btn-primary btn-sm me-1" data-bs-toggle="modal" data-bs-target="#Bayar<?php echo $row['id_order'] ?>"><i class="bi bi-cash-coin"></i> Bayar</button>
         </div>
     </div>
 </div>

 </div>