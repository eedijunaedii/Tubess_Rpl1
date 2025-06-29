<?php
    include 'proses/connect.php'; // Pastikan file connect.php sudah ada

    // Ambil kode_order dari URL
    $kode_order = (isset($_GET['order'])) ? htmlentities($_GET['order']) : "";

    $pelanggan = 'Pelanggan'; // Nilai default jika order tidak ditemukan atau nama pelanggan kosong
    $order_found = false; // Flag untuk menandakan apakah order ditemukan

    if (!empty($kode_order)) {
        // Ambil data pelanggan dari tabel tb_order berdasarkan kode_order
        $query_order = mysqli_query($conn, "SELECT pelanggan FROM tb_order WHERE id_order = '$kode_order'");
        
        // Periksa apakah query berhasil dan mengembalikan setidaknya satu baris
        if ($query_order && mysqli_num_rows($query_order) > 0) {
            $data_order = mysqli_fetch_array($query_order);
            // Pastikan kolom 'pelanggan' tidak kosong sebelum menggunakannya
            if (!empty($data_order['pelanggan'])) {
                $pelanggan = $data_order['pelanggan'];
            }
            $order_found = true; // Set flag menjadi true karena order ditemukan
        }
    }
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Kuesioner Kepuasan Pelanggan
        </div>
        <div class="card-body">
            <?php if ($order_found) { // Tampilkan form jika order ditemukan ?>
                <h5 class="card-title">Halo, <?php echo $pelanggan; ?>!</h5>
                <p class="card-text">Kami sangat menghargai waktu Anda untuk mengisi kuesioner ini. Pendapat Anda sangat penting bagi kami untuk terus meningkatkan pelayanan.</p>
                <hr>
                <form action="proses/proses_input_kepuasan.php" method="POST" class="needs-validation" novalidate>
                    <input type="hidden" name="kode_order" value="<?php echo $kode_order; ?>">

                    <div class="mb-3">
                        <label for="rating_makanan" class="form-label">Bagaimana kepuasan Anda terhadap kualitas makanan/minuman?</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating_makanan" id="makanan1" value="1" required>
                                <label class="form-check-label" for="makanan1">1 (Sangat Buruk)</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating_makanan" id="makanan2" value="2">
                                <label class="form-check-label" for="makanan2">2 (Buruk)</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating_makanan" id="makanan3" value="3">
                                <label class="form-check-label" for="makanan3">3 (Cukup)</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating_makanan" id="makanan4" value="4">
                                <label class="form-check-label" for="makanan4">4 (Baik)</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating_makanan" id="makanan5" value="5">
                                <label class="form-check-label" for="makanan5">5 (Sangat Baik)</label>
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            Mohon berikan penilaian untuk kualitas makanan/minuman.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="rating_pelayanan" class="form-label">Bagaimana kepuasan Anda terhadap pelayanan staf kami?</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating_pelayanan" id="pelayanan1" value="1" required>
                                <label class="form-check-label" for="pelayanan1">1 (Sangat Buruk)</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating_pelayanan" id="pelayanan2" value="2">
                                <label class="form-check-label" for="pelayanan2">2 (Buruk)</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating_pelayanan" id="pelayanan3" value="3">
                                <label class="form-check-label" for="pelayanan3">3 (Cukup)</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating_pelayanan" id="pelayanan4" value="4">
                                <label class="form-check-label" for="pelayanan4">4 (Baik)</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating_pelayanan" id="pelayanan5" value="5">
                                <label class="form-check-label" for="pelayanan5">5 (Sangat Baik)</label>
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            Mohon berikan penilaian untuk pelayanan staf.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="komentar" class="form-label">Apakah ada saran atau komentar tambahan?</label>
                        <textarea class="form-control" id="komentar" name="komentar" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" name="submit_kepuasan" value="1">Kirim Feedback</button>
                </form>
            <?php } else { // Tampilkan pesan error jika order tidak ditemukan ?>
                <div class="alert alert-danger" role="alert">
                    Informasi pesanan tidak ditemukan atau tidak valid. Pastikan Anda mengakses halaman ini setelah pembayaran yang sah.
                </div>
            <?php } ?>
        </div>
    </div>
</div>