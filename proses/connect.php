<?php 
    $conn = mysqli_connect('localhost', 'root', '', 'db_pak_resto');
    if(!$conn){
        echo "gagal koneksi";
    }
?>