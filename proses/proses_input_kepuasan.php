<?php
session_start();
include "connect.php";

$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";
$rating_makanan = (isset($_POST['rating_makanan'])) ? htmlentities($_POST['rating_makanan']) : "";
$rating_pelayanan = (isset($_POST['rating_pelayanan'])) ? htmlentities($_POST['rating_pelayanan']) : "";
$komentar = (isset($_POST['komentar'])) ? htmlentities($_POST['komentar']) : "";

if (!empty($_POST['submit_kepuasan'])) {
    $query = mysqli_query($conn, "INSERT INTO tb_kepuasan_pelanggan (kode_order, rating_makanan, rating_pelayanan, komentar)
    VALUES ('$kode_order', '$rating_makanan', '$rating_pelayanan', '$komentar')");

    if ($query) {
        $message = '<script>alert("Terima kasih atas feedback Anda!");
        window.location="../home"</script>'; // Redirect ke halaman home setelah feedback
    } else {
        $message = '<script>alert("Gagal menyimpan feedback. Silakan coba lagi.");
        window.location="../?x=kepuasan&order='.$kode_order.'"</script>'; // Kembali ke halaman kuesioner jika gagal
    }
} else {
    $message = '<script>alert("Telah terjadi kesalahan.");
    window.location="../home"</script>';
}
echo $message;
?>