    <?php 
    include "proses/connect.php";
    $query = mysqli_query($conn, "SELECT * FROM user WHERE username='$_SESSION[username_pakresto]'");
    $records = mysqli_fetch_array($query);
    ?>
    <nav class="navbar navbar-expand navbar-dark bg-primary sticky-top">
        <div class="container-lg">
            <a class="navbar-brand" href="."><i class="bi bi-shop-window"></i> Pak Resto</a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php
                            echo $hasil['username'];
                            ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-2">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalUbahProfile"><i class="bi bi-person-fill"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalUbahPassword"><i class="bi bi-key"></i> Ubah Password</a></li>
                            <li><a class="dropdown-item" href="logout"><i class="bi bi-arrow-left-square"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Modal Ubah Password-->
    <div class="modal fade" id="ModalUbahPassword" tabindex="-1" aria-labelledby="ModalEdit" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="proses/proses_ubah_password.php" method="POST" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input disabled type="text" class="form-control" id="floatingInput" placeholder="YourName" name="username" required value="<?php echo $_SESSION['username_pakresto'] ?>">
                                    <label for="floatingInput">Username</label>
                                    <div class="invalid-feedback">
                                        Masukkan Username
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="floatingpassword" name="passwordlama" required>
                                    <label for="floatingInput">Password Lama</label>
                                    <div class="invalid-feedback">
                                        Masukkan Password Lama
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="floatingInput" name="passwordbaru" required>
                                    <label for="floatingInput">Password Baru</label>
                                    <div class="invalid-feedback">
                                        Masukkan Password Baru
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="floatingpassword" name="repasswordbaru" required>
                                    <label for="floatingInput">Ulangi Password Baru</label>
                                    <div class="invalid-feedback">
                                        Masukkan Ulangi Password Baru
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="ubah_password_validate" value="12345">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Modal Ubah Password-->

    <!-- Modal Ubah Profile-->
    <div class="modal fade" id="ModalUbahProfile" tabindex="-1" aria-labelledby="ModalUbahProfile" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="proses/proses_ubah_profile.php" method="POST" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-floating mb-3">
                                    <input disabled type="text" class="form-control" id="floatingInput" placeholder="YourName" name="username" required value="<?php echo $_SESSION['username_pakresto'] ?>">
                                    <label for="floatingInput">Username</label>
                                    <div class="invalid-feedback">
                                        Masukkan Username
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingpassword" name="nama" required value="<?php echo $records['nama'] ?>">
                                    <label for="floatingInput">Nama</label>
                                    <div class="invalid-feedback">
                                        Masukkan Nama Anda
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="floatingInput" name="nohp" required value="<?php echo $records['nohp'] ?>">
                                    <label for="floatingInput">No Hp</label>
                                    <div class="invalid-feedback">
                                        Masukkan Nomor Hp Anda
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="" style="height: 100px;" name="alamat" required><?php echo $records['alamat'] ?></textarea>
                                    <label for="floatingInput">Alamat</label>
                                    <div class="invalid-feedback">
                                        Masukkan Alamat Anda
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="ubah_profile_validate" value="12345">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Modal Ubah Profile-->