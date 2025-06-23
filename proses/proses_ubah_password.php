<?php
session_start();
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$passwordlama = (isset($_POST['passwordlama'])) ? md5(htmlentities($_POST['passwordlama'])) : "";
$passwordbaru = (isset($_POST['passwordbaru'])) ? md5(htmlentities($_POST['passwordbaru'])) : "";
$repasswordbaru = (isset($_POST['repasswordbaru'])) ? md5(htmlentities($_POST['repasswordbaru'])) : "";

if (!empty($_POST['ubah_password_validate'])) {
    $query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$_SESSION[username_pakresto]' AND password = '$passwordlama'");
    $hasil = mysqli_fetch_array($query);
    if ($hasil) {
        if ($passwordbaru == $repasswordbaru) {
            $query = mysqli_query($conn, "UPDATE user SET password='$passwordbaru' WHERE username = '$_SESSION[username_pakresto]'");
            if ($query) {
                $message = '<script>alert("Password Berhasil DiUbah");
                 window.history.back()</script>
                 </script>';
            } else {
                $message = '<script>alert("Password Gagal DiUbah")
                window.history.back()</script>
                </script>';
            }
        }else {
            $message = '<script>alert("Password Baru Tidak Sama")
            window.history.back()</script>
            </script>';
        }
    } else {
       $message = '<script>alert("Password Lama Tidak Sama")
       window.history.back()</script>
       </script>';

    }
}else{
    header('location../home');
}
echo $message;
