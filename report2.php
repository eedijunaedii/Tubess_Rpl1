<?php
include 'proses/connect.php'; // Pastikan file connect.php sudah ada

date_default_timezone_set('Asia/Jakarta'); // Atur zona waktu sesuai lokasi Anda

// 3. Helper: fungsi untuk mengubah angka rating jadi teks
if (! function_exists('getRatingText')) {
    /**
     * Ubah rating numerik (1–5) menjadi teks.
     *
     * @param int $rating
     * @return string
     */
    function getRatingText(int $rating): string
    {
        switch ($rating) {
            case 1: return 'Sangat Buruk';
            case 2: return 'Buruk';
            case 3: return 'Cukup';
            case 4: return 'Baik';
            case 5: return 'Sangat Baik';
            default: return '-';
        }
    }
}

// Query untuk mengambil data feedback kepuasan pelanggan
// Tanpa CASE WHEN di SQL, rating akan diambil dalam bentuk angka
$query = mysqli_query($conn, "SELECT
                                 tb_kepuasan_pelanggan.id,
                                 tb_kepuasan_pelanggan.kode_order,
                                 tb_kepuasan_pelanggan.rating_makanan,
                                 tb_kepuasan_pelanggan.rating_pelayanan,
                                 tb_kepuasan_pelanggan.komentar,
                                 tb_kepuasan_pelanggan.waktu_submit,
                                 tb_order.pelanggan
                                 FROM tb_kepuasan_pelanggan
                                 LEFT JOIN tb_order ON tb_kepuasan_pelanggan.kode_order = tb_order.id_order
                                 ORDER BY tb_kepuasan_pelanggan.waktu_submit DESC");

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
                                    <td>
                                        <?php echo getRatingText($row['rating_makanan']); ?>
                                    </td>
                                    <td>
                                        <?php echo getRatingText($row['rating_pelayanan']); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($row['komentar']); ?></td>
                                    <td>
                                        <?php
                                        // Format waktu_submit untuk menghilangkan mikrodetik
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