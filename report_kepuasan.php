<?php
    include 'proses/connect.php'; 
    date_default_timezone_set('Asia/Jakarta'); 

    $query = mysqli_query($conn, "SELECT tkp.*, to.pelanggan,
                                 CASE tkp.rating_makanan
                                     WHEN 1 THEN 'Sangat Buruk'
                                     WHEN 2 THEN 'Buruk'
                                     WHEN 3 THEN 'Cukup'
                                     WHEN 4 THEN 'Baik'
                                     WHEN 5 THEN 'Sangat Baik'
                                     ELSE '-'
                                 END AS rating_makanan_text,
                                 CASE tkp.rating_pelayanan
                                     WHEN 1 THEN 'Sangat Buruk'
                                     WHEN 2 THEN 'Buruk'
                                     WHEN 3 THEN 'Cukup'
                                     WHEN 4 THEN 'Baik'
                                     WHEN 5 THEN 'Sangat Baik'
                                     ELSE '-'
                                 END AS rating_pelayanan_text
                                 FROM tb_kepuasan_pelanggan tkp
                                 LEFT JOIN tb_order to ON tkp.kode_order = to.id_order
                                 ORDER BY tkp.waktu_submit DESC");

    $result = [];
    if ($query) {
        while ($record = mysqli_fetch_array($query)) {
            $result[] = $record;
        }
    }
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Halaman Laporan Kepuasan Pelanggan
        </div>
        <div class="card-body">
            <?php
                if (empty($result)) {
                    echo "Data feedback kepuasan pelanggan tidak ada.";
                } else {
            ?>
                <div class="table-responsive">
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr class="text-nowrap">
                                <th scope="col">No</th>
                                <th scope="col">Kode Order</th>
                                <th scope="col">Pelanggan</th>
                                <th scope="col">Rating Makanan</th>
                                <th scope="col">Rating Pelayanan</th>
                                <th scope="col">Komentar</th>
                                <th scope="col">Waktu Submit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach ($result as $row) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $no++; ?></th>
                                    <td><?php echo htmlspecialchars($row['kode_order']); ?></td>
                                    <td><?php echo htmlspecialchars($row['pelanggan'] ?? 'N/A'); ?></td>
                                    <td><?php echo htmlspecialchars($row['rating_makanan_text']); ?></td>
                                    <td><?php echo htmlspecialchars($row['rating_pelayanan_text']); ?></td>
                                    <td><?php echo htmlspecialchars($row['komentar']); ?></td>
                                    <td>
                                        <?php
                                            $tanggal_waktu_obj = new DateTime($row['waktu_submit']);
                                            echo $tanggal_waktu_obj->format('Y-m-d H:i:s');
                                        ?>
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