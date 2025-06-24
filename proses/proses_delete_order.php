<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";

if (!empty($_POST['delete_order_validate'])) {
    $select = mysqli_query($conn, "SELECT kode_order FROM list_order WHERE kode_order = '$kode_order'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Order telah memiliki item order, data order ini tidak dapat dihapus")
        window.location="../order"</script>';
    } else {
        $query = mysqli_query($conn, "DELETE FROM tb_order WHERE id_order= '$kode_order'");

        if ($query) {
            $message = '<script>alert("Data Berhasil DiHapus")
            window.location="../order"</script>';
        } else {
            $message = '<script>alert("Data Gagal DiHapus")
            window.location="../order"</script>';
        }
    }
}
echo $message;
