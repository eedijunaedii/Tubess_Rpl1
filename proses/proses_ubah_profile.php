<?php
session_start();
include "connect.php";
$nama = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : "";
$nohp = (isset($_POST['nohp'])) ? htmlentities($_POST['nohp']) : "";
$alamat = (isset($_POST['alamat'])) ? htmlentities($_POST['alamat']) : "";

if (!empty($_POST['ubah_profile_validate'])) {
            $query = mysqli_query($conn, "UPDATE user SET nama='$nama', nohp='$nohp', alamat='$alamat' WHERE username = '$_SESSION[username_pakresto]'");
            if ($query) {
                $message = '<script>alert("Data Profile Berhasil DiUpdate");
                window.history.back()</script>';
            } else{
                $message = '<script>alert("Data Profile Gagal DiUpdate");
                window.history.back()</script>';
            }
        }else{
            $message = '<script>alert("Telah terjadi kesalahan");
            window.history.back()</script>';
        }
echo $message;
?>
