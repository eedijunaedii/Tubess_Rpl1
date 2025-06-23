<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$jenis_menu = (isset($_POST['jenis_menu'])) ? htmlentities($_POST['jenis_menu']) : "";
$katmenu = (isset($_POST['katmenu'])) ? htmlentities($_POST['katmenu']) : "";


if (!empty($_POST['input_katmenu_validate'])) {
    $select = mysqli_query($conn, "SELECT kategori_menu FROM kategori_menu WHERE kategori_menu = '$katmenu'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Kategori Yang Dimasukan Telah Ada")
        window.location="../katmenu"</script>';
    } else {
    $query = mysqli_query($conn, "UPDATE kategori_menu SET jenis_menu='$jenis_menu', kategori_menu='$katmenu' WHERE id_kat_menu='$id'");
    if ($query){
        $message ='<script>alert("Kategori Berhasil DiUpdate")
        window.location="../katmenu"</script>';
        
    } else {
        $message ='<script>alert("Kategori Gagal DiUpdate")
        window.location="../katmenu"</script>';
    }
}
}echo $message;
