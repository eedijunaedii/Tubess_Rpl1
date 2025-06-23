<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";

if (!empty($_POST['hapus_katmenu_validate'])) {
    $select = mysqli_query($conn, "SELECT kategori FROM daftar_menu WHERE kategori = '$id'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Kategori Telah Digunakan Pada Daftar Menu, Kategori Tidak Dapat Dihapus")
        window.location="../katmenu"</script>';
    } else {
        $query = mysqli_query($conn, "DELETE FROM kategori_menu WHERE id_kat_menu= '$id'");
        if ($query) {
            $message = '<script>alert("Data Berhasil DiHapus")
        window.location="../katmenu"</script>';
        } else {
            $message = '<script>alert("Data Gagal DiHapus")
        window.location="../katmenu" </script>';
        }
    }
}
echo $message;
