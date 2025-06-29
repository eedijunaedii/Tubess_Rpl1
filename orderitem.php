 <?php
    include 'proses/connect.php';
    $query = mysqli_query($conn, "SELECT *, SUM(harga * jumlah) AS harganya, tb_order.waktu_order FROM list_order
        LEFT JOIN tb_order ON tb_order.id_order = list_order.kode_order  
        LEFT JOIN daftar_menu ON daftar_menu.id = list_order.menu   
        LEFT JOIN bayar ON bayar.id_bayar = tb_order.id_order   
        GROUP BY id_list_order
        HAVING list_order.kode_order = $_GET[order]");
    $kode = $_GET['order'];
    $meja = $_GET['meja'];
    $pelanggan = $_GET['pelanggan'];

    while ($record = mysqli_fetch_array($query)) {
        $result[] = $record;
        // $kode = $record['id_order'];
        // $meja = $record['meja'];
        // $pelanggan = $record['pelanggan'];
    }

    $select_menu = mysqli_query($conn, "SELECT id,nama_menu FROM daftar_menu");
    ?>

 <div class="col-lg-9 mt-2">
     <div class="card">
         <div class="card-header">
             Halaman Order Item
         </div>
         <div class="card-body">
             <a class="btn btn-info mb-3" href="order"><i class="bi bi-arrow-left"></i></a>
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
             <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu Makanan Dan Minuman</h1>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                         <form action="proses/proses_input_orderitem.php" method="POST" class="needs-validation" novalidate>
                             <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                             <input type="hidden" name="meja" value="<?php echo $meja ?>">
                             <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                             <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-floating mb-3">
                                         <select class="form-select" name="menu" id="">
                                             <option selected hidden value="">Pilih Menu</option>
                                             <?php
                                                foreach ($select_menu as $value) {
                                                    echo "<option value=$value[id]>$value[nama_menu]</option>";
                                                }
                                                ?>
                                         </select>
                                         <label for="menu">Menu Makanan/Minuman</label>
                                         <div class="invalid-feedback">
                                             Pilih Menu
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-lg-4">
                                     <div class="form-floating mb-3">
                                         <input type="number" class="form-control" id="floatingInput" placeholder="jumlah" name="jumlah" required>
                                         <label for="floatingInput">Jumlah Porsi</label>
                                         <div class="invalid-feedback">
                                             Masukkan Jumlah Porsi
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-lg-12">
                                 <div class="form-floating mb-3">
                                     <input type="text" class="form-control" id="floatingInput" placeholder="catatan" name="catatan" required>
                                     <label for="floatingInput">Catatan</label>
                                     <div class="invalid-feedback">
                                         Masukkan Catatan
                                     </div>
                                 </div>
                             </div>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                         <button type="submit" class="btn btn-primary" name="input_orderitem_validate" value="12345">Save changes</button>
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
             <!-- Modal edit menu -->
             <div class="modal fade" id="ModalEdit<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="ModalEdit" aria-hidden="true">
                 <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu Makanan Dan Minuman</h1>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                         <div class="modal-body">
                             <form action="proses/proses_edit_orderitem.php" method="POST" class="needs-validation" novalidate>
                                 <input type="hidden" name="id" value="<?php echo $row['id_list_order'] ?>">
                                 <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                 <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                 <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                 <div class="row">
                                     <div class="col-lg-6">
                                         <div class="form-floating mb-3">
                                             <select class="form-select" name="menu" id="">
                                                 <option selected hidden value="">Pilih Menu</option>
                                                 <?php
                                                    foreach ($select_menu as $value) {
                                                        if ($row['menu'] == $value['id']) {
                                                            echo "<option selected value=$value[id]>$value[nama_menu]</option>";
                                                        } else {
                                                            echo "<option value=$value[id]>$value[nama_menu]</option>";
                                                        }
                                                    }
                                                    ?>
                                             </select>
                                             <label for="menu">Menu Makanan/Minuman</label>
                                             <div class="invalid-feedback">
                                                 Pilih Menu
                                             </div>
                                         </div>
                                     </div>
                                     <div class="col-lg-4">
                                         <div class="form-floating mb-3">
                                             <input type="number" class="form-control" id="floatingInput" placeholder="jumlah" name="jumlah" required value="<?php echo $row['jumlah'] ?>">
                                             <label for="floatingInput">Jumlah Porsi</label>
                                             <div class="invalid-feedback">
                                                 Masukkan Jumlah Porsi
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-lg-12">
                                     <div class="form-floating mb-3">
                                         <input type="text" class="form-control" id="floatingInput" placeholder="catatan" name="catatan" required value="<?php echo $row['catatan'] ?>">
                                         <label for="floatingInput">Catatan</label>
                                         <div class="invalid-feedback">
                                             Masukkan Catatan
                                         </div>
                                     </div>
                                 </div>
                         </div>
                         <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                             <button type="submit" class="btn btn-primary" name="edit_orderitem_validate" value="12345">Save changes</button>
                         </div>
                         </form>
                     </div>
                 </div>
             </div>
             <!-- akhir modal edit menu -->

             <!-- Modal Delete-->
             <div class="modal fade" id="ModalDelet<?php echo $row['id_list_order'] ?>" tabindex="-1" aria-labelledby="ModalDelet" aria-hidden="true">
                 <div class="modal-dialog modal-md modal-fullscreen-md-down">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Data Menu</h1>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                         <div class="modal-body">

                             <form action="proses/proses_delete_orderitem.php" method="POST" class="needs-validation" novalidate>
                                 <input type="hidden" value="<?php echo $row['id_list_order'] ?>" name="id">
                                 <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                                 <input type="hidden" name="meja" value="<?php echo $meja ?>">
                                 <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                 <div class="col-lg-12">
                                     Apakah anda ingin menghapus menu <b><?php echo $row['nama_menu'] ?></b>
                                 </div>
                                 <div class="modal-footer">
                                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                     <button type="submit" class="btn btn-danger" name="delete_orderitem_validate" value="12345">Hapus</button>
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

         <!-- Modal bayar item -->
         <div class="modal fade" id="bayar" tabindex="-1" aria-labelledby="TambahItem" aria-hidden="true">
             <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h1 class="modal-title fs-5" id="exampleModalLabel">Pembayaran Menu Makanan Dan Minuman</h1>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                         <div class="table-responsive">
                             <table class="table table-hover">
                                 <thead>
                                     <tr class="text-nowrap">
                                         <th scope="col">Menu</th>
                                         <th scope="col">Harga</th>
                                         <th scope="col">Jumlah</th>
                                         <th scope="col">Status</th>
                                         <th scope="col">Catatan</th>
                                         <th scope="col">Total</th>
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
                                             <td><?php echo $row['status'] ?></td>
                                             <td><?php echo $row['catatan'] ?></td>
                                             <td><?php echo number_format($row['harganya'], 0, ',', '.')  ?></td>
                                         </tr>
                                     <?php
                                            $total += $row['harganya'];
                                        } ?>
                                     <tr>
                                         <td colspan="5" class="fw-bold">
                                             Total Harga
                                         </td>
                                         <td class="fw-bold">
                                             <?php echo number_format($total, 0, ',', '.')  ?>
                                         </td>
                                     </tr>
                                 </tbody>
                             </table>
                         </div>
                         <span class="text-danger fs-5 fw-semibold">Apakah Anda Yakin Ingin Melakukan Pembayaran?</span>
                         <form action="proses/proses_bayar.php" method="POST" class="needs-validation" novalidate>
                             <input type="hidden" name="kode_order" value="<?php echo $kode ?>">
                             <input type="hidden" name="meja" value="<?php echo $meja ?>">
                             <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                             <input type="hidden" name="total" value="<?php echo $total ?>">
                             <div class="col-lg-12">
                                 <div class="form-floating mb-3">
                                     <input type="number" class="form-control" id="floatingInput" placeholder="Nominal Uang" name="uang" required>
                                     <label for="floatingInput">Nominal Uang</label>
                                     <div class="invalid-feedback">
                                         Masukkan Nominal Uang
                                     </div>
                                 </div>
                             </div>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                         <button type="submit" class="btn btn-primary" name="bayar_validate" value="12345">Bayar</button>
                     </div>
                     </form>
                 </div>
             </div>
         </div>
         <!-- akhir modal bayar item -->
         <div class="table-responsive">
             <table class="table table-hover">
                 <thead>
                     <tr class="text-nowrap">
                         <th scope="col">Menu</th>
                         <th scope="col">Harga</th>
                         <th scope="col">Jumlah</th>
                         <th scope="col">Status</th>
                         <th scope="col">Catatan</th>
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
                             <td>
                                 <?php
                                    if ($row['status'] == 1) {
                                        echo "<span class='badge text-bg-warning'>Masuk Ke Dapur</span>";
                                    } elseif ($row['status'] == 2) {
                                        echo "<span class='badge text-bg-primary'>Siap Saji</span>";
                                    }
                                    ?>
                             </td>
                             <td><?php echo $row['catatan'] ?></td>
                             <td><?php echo number_format($row['harganya'], 0, ',', '.')  ?></td>
                             <td>
                                 <div class="d-flex">
                                     <button class="<?php echo (!empty($row['id_bayar'])) ? " btn btn-secondary disabled" : "btn btn-warning" ?> btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id_list_order'] ?>"><i class="bi bi-pencil-square"></i></button>
                                     <button class="<?php echo (!empty($row['id_bayar'])) ? " btn btn-secondary disabled" : "btn btn-danger " ?> btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalDelet<?php echo $row['id_list_order'] ?>"><i class="bi bi-trash"></i></button>
                                 </div>
                             </td>
                         </tr>
                     <?php
                            $total += $row['harganya'];
                        } ?>
                     <tr>
                         <td colspan="5" class="fw-bold">
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
         <button class="<?php echo (!empty($row['id_bayar'])) ? " btn btn-secondary disabled" : "btn btn-success" ?> btn-sm me-1" data-bs-toggle="modal" data-bs-target="#TambahItem"><i class="bi bi-plus-circle"></i> Item</button>
         <button class="<?php echo (!empty($row['id_bayar'])) ? " btn btn-secondary disabled" : "btn btn-primary" ?> btn-sm me-1" data-bs-toggle="modal" data-bs-target="#bayar"><i class="bi bi-cash-coin"></i> Bayar</button>
         <button onclick="printstruk()" class="btn btn-info">Cetak Struk</button>
     </div>
 </div>
 </div>

 </div>
 <div id="strukContent" class="d-none">
     <style>
         #struk {
            font-family: "Arial", sans-serif;
             font-size: 12px;
             max-width: 300px;
             border: 1px solid #000;
             padding: 10px;
             width: 80mm;
             margin: auto;
         }
         #struk p{
            margin: 5px;
         }
         #struk h2{
            text-align: center;
            color: #000;
            margin-bottom: 10px;
            font-size: 16px;
         }
         #struk table {
             font-size: 12px;
             border-collapse: collapse;
             margin-top: 10px;
             width: 100%;
         }
         #struk th, #struk td {
            border: 1px solid #999;
            padding: 6px;
            font-size: 12px;
            text-align: left;
         }
         #struk .total{
            font-weight: bold;
         }

     </style>
     <div id="struk">
         <h2>Struk Pembayaran Pakresto</h2>
         <p>Kode Order: <?php echo $kode ?></p>
         <p>Meja:<?php echo $meja ?></p>
         <p>Pelanggan:<?php echo $pelanggan ?></p>
         <p>Waktu Order:<?php echo date('d/m/Y H:i:s', strtotime($result[0]['waktu_order'])) ?></p>

         <table>
             <thead>
                 <tr>
                     <th>Menu</th>
                     <th>Harga</th>
                     <th>Jumlah</th>
                     <th>Total</th>
                 </tr>
             </thead>
             <tbody>
                 <?php
                    $total = 0;
                    foreach ($result as $row) { ?>
                     <tr>
                         <td><?php echo $row['nama_menu'] ?></td>
                         <td><?php echo number_format($row['harga'], 0, ',', '.') ?></td>
                         <td><?php echo $row['jumlah'] ?></td>
                         <td><?php echo number_format($row['harganya'], 0, ',', '.') ?></td>
                     </tr>
                 <?php
                        $total += $row['harganya'];
                    } ?>
                 <tr class="total">
                     <td colspan="3">Total Harga</td>
                     <td><?php echo number_format($total, 0, ',', '.') ?></td>
                 </tr>
             </tbody>
         </table>
     </div>
 </div>

 <script>
     function printstruk() {
         var strukContent = document.getElementById("strukContent").innerHTML;

         var printFrame = document.createElement('iframe');
         printFrame.style.display = 'none';
         document.body.appendChild(printFrame);
         printFrame.contentDocument.write(strukContent);
         printFrame.contentWindow.print();
         document.body.removeChild(printFrame);
     }
 </script>