<?php
session_start();
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$catatan = (isset($_POST['catatan'])) ? htmlentities($_POST['catatan']) : "";

if (!empty($_POST['terima_orderitem_validate'])) {
        $query = mysqli_query($conn, "UPDATE list_order SET catatan='$catatan', status=1 WHERE id_list_order='$id'");
        if ($query) {
            $message = '<script>alert("Order Berhasil diterima oleh dapur");
        window.location="../dapur"</script>';
        } else {
            $message = '<script>alert("Order Gagal diterima oleh dapur")
             window.location="../dapur"</script>';
        }
    }
echo $message;
?>
