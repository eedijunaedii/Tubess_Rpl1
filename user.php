 <?php
    include 'proses/connect.php';
    $query = mysqli_query($conn, "SELECT * FROM user");
    while ($record = mysqli_fetch_array($query)) {
        $result[] = $record;
    }
    ?>

 <div class="col-lg-9 mt-2">
     <div class="card">
         <div class="card-header">
             Halaman User
         </div>
         <div class="card-body">
             <div class="row">
                 <div class="col d-flex justify-content-end">
                     <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTambahUser">Tambah User</button>
                 </div>
             </div>
             <!-- Modal Tambah user baru -->
             <div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="ModalTambahUser" aria-hidden="true">
                 <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                         <div class="modal-body">
                             <form action="proses/proses_input_user.php" method="POST" class="needs-validation" novalidate>
                                 <div class="row">
                                     <div class="col-lg-6">
                                         <div class="form-floating mb-3">
                                             <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" required>
                                             <label for="floatingInput">Username</label>
                                             <div class="invalid-feedback">
                                                 Masukkan Username
                                             </div>
                                         </div>
                                     </div>
                                     <div class="col-lg-6">
                                         <div class="form-floating mb-3">
                                             <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="nama" required>
                                             <label for="floatingInput">Nama</label>
                                             <div class="invalid-feedback">
                                                 Masukkan Nama
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                         </div>
                         <div class="row">
                             <div class="col-lg-6">
                                 <div class="form-floating mb-3">
                                     <input type="password" class="form-control" id="floatingPassword" placeholder="Password" disabled value="12345" name="password">
                                     <label for="floatingPassword">Password</label>
                                 </div>
                             </div>
                         </div>
                         <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                             <button type="submit" class="btn btn-primary" name="input_user_validate" value="12345">Save changes</button>
                         </div>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
         <!-- akhir modal tambah user baru -->
         <?php foreach ($result as $row) {
            ?>
             <!-- Modal view-->
             <div class="modal fade" id="ModalView<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="ModalView" aria-hidden="true">
                 <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data User</h1>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                         <div class="modal-body">
                             <form action="proses/proses_input_user.php" method="POST" class="needs-validation" novalidate>
                                 <div class="row">
                                     <div class="col-lg-6">
                                         <div class="form-floating mb-3">
                                             <input disabled type="email" class="form-control" id="floatingInput" placeholder="YourName" name="username" value="<?php echo $row['username'] ?>">
                                             <label for="floatingInput">Username</label>
                                             <div class="invalid-feedback">
                                                 Masukkan Username
                                             </div>
                                         </div>
                                     </div>
                                     <div class="col-lg-6">
                                         <div class="form-floating mb-3">
                                             <input disabled type="text" class="form-control" id="floatingInput" placeholder="YourName" name="nama" value="<?php echo $row['nama'] ?>">
                                             <label for="floatingInput">Nama</label>
                                             <div class="invalid-feedback">
                                                 Masukkan Nama
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="modal-footer">
                                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                 </div>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- Akhir Modal view-->

             <!-- Modal Delete-->
             <div class="modal fade" id="ModalDelet<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="ModalDelet" aria-hidden="true">
                 <div class="modal-dialog modal-md modal-fullscreen-md-down">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Data User</h1>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                         <div class="modal-body">
                             <form action="proses/proses_delete_user.php" method="POST" class="needs-validation" novalidate>
                                 <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                 <div class="col-lg-12">
                                     <?php
                                        if ($row['username'] == $_SESSION['username_pakresto']) {
                                            echo "<div class='alert alert-danger'>Anda Tidak Dapat Menghapus Akun Sendiri.</div>";
                                        } else {
                                            echo "Apakah Anda Yakin Ingin Menghapus User <b> $row[username]</b>";
                                        }
                                        ?>
                                 </div>
                                 <div class="modal-footer">
                                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                     <button type="submit" class="btn btn-danger" name="input_user_validate" value="12345" <?php echo ($row['username'] == $_SESSION['username_pakresto']) ? 'disabled' : ''; ?>>Hapus</button>
                                 </div>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- Akhir Modal Delete-->

             <!-- Modal Reset Password-->
             <div class="modal fade" id="ModalResetPassword<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="ModalResetPassword" aria-hidden="true">
                 <div class="modal-dialog modal-md modal-fullscreen-md-down">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Data User</h1>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                         <div class="modal-body">
                             <form action="proses/proses_reset_password.php" method="POST" class="needs-validation" novalidate>
                                 <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                 <div class="col-lg-12">
                                     <?php
                                        if ($row['username'] == $_SESSION['username_pakresto']) {
                                            echo "<div class='alert alert-danger'>Anda Tidak Dapat Mereset Password Sendiri.</div>";
                                        } else {
                                            echo "Apakah Anda Yakin Ingin Mereset Password User <b> $row[username]</b> menjadi password bawaan sistem yaitu <b> password </b>";
                                        }
                                        ?>
                                 </div>
                                 <div class="modal-footer">
                                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                     <button type="submit" class="btn btn-success" name="input_user_validate" value="12345" <?php echo ($row['username'] == $_SESSION['username_pakresto']) ? 'disabled' : ''; ?>>Reset Password</button>
                                 </div>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- Akhir Modal Reset Password-->
         <?php
            }
            if (empty($result)) {
                echo "Data user tidak ada";
            } else {
            ?>
             <div class="table-responsive">
                 <table class="table table-hover" id="example">
                     <thead>
                         <tr>
                             <th scope="col">No</th>
                             <th scope="col">Email</th>
                             <th scope="col">Nama</th>
                             <th scope="col">Username</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                            $no = 1;
                            foreach ($result as $row) {
                            ?>
                             <tr>
                                 <th scope="row"><?php echo $no++ ?></th>
                                 <td><?php echo $row['email'] ?></td>
                                 <td><?php echo $row['nama'] ?></td>
                                 <td><?php echo $row['username'] ?></td>
                                 <td class="d-flex">
                                     <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalView<?php echo $row['id'] ?>"><i class="bi bi-eye"></i></button>
                                     <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id'] ?>"><i class="bi bi-pencil-square"></i></button>
                                     <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalDelet<?php echo $row['id'] ?>"><i class="bi bi-trash"></i></button>
                                     <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalResetPassword<?php echo $row['id'] ?>"><i class="bi bi-key-fill"></i></button>
                                 </td>
                             </tr>
                         <?php } ?>
                     </tbody>
                 </table>
             </div>
         <?php } ?>
     </div>
 </div>

 </div>