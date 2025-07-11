 <?php
    include 'proses/connect.php';
    $query = mysqli_query($conn, "SELECT *, SUM(harga * jumlah) AS harganya FROM list_order
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
             Halaman View Item
         </div>
         <div class="card-body">
             <a class="btn btn-info mb-3" href="report"><i class="bi bi-arrow-left"></i></a>
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
     <?php
        if (empty($result)) {
            echo "Data Menu Makanan atau Minuman tidak ada";
        } else {
            foreach ($result as $row) {
        ?>
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
 </div>
 </div>

 </div>