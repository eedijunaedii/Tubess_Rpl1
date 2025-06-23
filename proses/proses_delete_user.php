<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";

if (!empty($_POST['input_user_validate'])) {
    $query = mysqli_query($conn,"DELETE FROM user WHERE id= '$id'");
    if ($query){
        $message ='<script>alert("Data Berhasil DiHapus")
        window.location="../user"</script>';
        
    } else {
        $message ='<script>alert("Data Gagal DiHapus")</script>';
    }
}echo $message;
