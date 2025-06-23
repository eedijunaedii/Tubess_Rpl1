<?php
session_start();
include "connect.php";
$username = (isset($_POST['username'])) ? htmlentities($_POST['username']) : "";
$password = (isset($_POST['password'])) ? md5(htmlentities($_POST['password'])) : "";
if (!empty($_POST['submit_validate'])) {
    $query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' AND password = '$password'");
    $hasil = mysqli_fetch_array($query);
    if ($hasil) {
        $_SESSION['username_pakresto'] = $username;
        $_SESSION['level_pakresto'] = $hasil['level'];
        header('location:../home');
    } else { ?>
        <script>
            alert('Username atau Password yang anda masukkan salah');
            window.location = '../login'
        </script>

<?php
    }
}
?>