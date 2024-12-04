<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">


        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->

            <?php
            $this->load->view('siswa/layout/navbar');
            ?>

            <!-- / Navbar -->

            <div class="content-wrapper">
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">
                    
                    <?php if (isset($validation_error)) {

                        echo '<div class="alert alert-danger mb-0 alert-dismissible" role="alert"><strong>Gagal !</strong>
                                    ' . $validation_error . '
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>';
                    } ?>
                    <?php if (isset($validation_errors)) {
                        echo '<div class="alert alert-danger mb-0 alert-dismissible" role="alert">
                                   ' . $validation_errors . '
                                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                 </div>';
                    } ?>

                    <?php if ($this->session->flashdata('not')) {
                        echo $this->session->flashdata('not');
                    } ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">

                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h5 class="mb-0"><i class='bx bx-user' style='color:#514c4c' ></i> Data Siswa</h5>
                                    <small class="text-muted float-end">
                                        <a href="<?= site_url('accountsiswa/cetak_kartu/' . $user['id_siswa']) ?>" class="btn btn-sm btn-danger"><i class='bx bx-printer'></i></a>

                                    </small>
                                </div>
                                <!-- Account -->
                                <div class="card-body">
                                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                                        <?php
                                        $foto_profil = $user['foto_siswa'];
                                        if (empty($foto_profil)) {

                                            $default_foto = base_url('asset/assets/img/avatars/1.png');
                                            echo '<img src="' . $default_foto . '" alt="Default Foto Profil" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />';
                                        } else {
                                            // Jika foto profil tidak kosong, tampilkan foto profil user
                                            $profil_foto = URL_IMG .$user['foto_siswa'];
                                            echo '<img src="' . $profil_foto . '" alt="Foto Profi" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />';
                                        }
                                        ?>
                                        <div class="button-wrapper">
                                            <p>Nama : <?= $user['nama_siswa'] ?></p>
                                            <p>Angkatan : <?= $user['angkatan_siswa'] ?></p>
                                        </div>
                                        <div class="button-wrapper">
                                            <img src="<?php echo site_url('accountsiswa/barcode/' . $user['nisn']) ?>" alt="Barcode <?php echo $user['nisn']; ?>" alt="Barcode">
                                        </div>
                                    </div>

                                </div>

                                <hr class="my-0" />
                                <div class="card-body">
                                    <form action="<?= site_url('Accountsiswa/tambah_foto') ?>" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="firstName" class="form-label">Nama Siswa</label>
                                                <input class="form-control" type="text" disabled value="<?= $user['nama_siswa']; ?>" />
                                                <input class="form-control" type="hidden" name="id_siswa" value="<?= $user['id_siswa']; ?>" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="lastName" class="form-label">Kelas</label>
                                                <input class="form-control" type="text" name="kelas" disabled value="<?= $user['kelas_siswa'] ?>" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="email" class="form-label">Jenis Kelamin </label>
                                                <input class="form-control" type="text" id="email" disabled name="email" value="<?php
                                                                                                                                if ($user['jenis_kelamin'] = '1') {
                                                                                                                                    echo 'Laki-laki';
                                                                                                                                } else {
                                                                                                                                    echo 'Perempuan';
                                                                                                                                } ?>" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="organization" class="form-label">Angkatan</label>
                                                <input type="text" class="form-control" disabled value="<?= $user['angkatan_siswa']; ?>" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="organization" class="form-label">Jurusan</label>
                                                <input type="text" class="form-control" disabled value="<?= $user['jurusan_siswa']; ?>" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="organization" class="form-label">No Hp</label>
                                                <input type="text" class="form-control" disabled value="<?= $user['no_hp']; ?>" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="address" class="form-label">Upload Foto Profil</label>
                                                <p class="text-muted mb-0">Type file : JPG,JEPG & PNG. Maximal Size 5 Mb</p>
                                                <input type="file" class="form-control" name="gambar" />
                                                <input class="form-control" type="hidden" name="id_siswa" value="<?= $user['id_siswa']; ?>" />
                                            </div>
                                            <div class="mt-2">
                                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                                <button type="reset" class="btn btn-outline-secondary">Batal</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <hr class="my-0" />

                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h5 class="mb-0">Username dan Password</h5>
                                    <small class="text-muted float-end">
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#basicModal">
                                            <i class='bx bxs-key'></i>
                                        </button>
                                    </small>
                                    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel1">Form Ubah Password</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="alert alert-warning" role="alert">Masukan Kombinasi Karakter yang kuat! Min. 7 karakter</div>
                                                    <form action="<?= site_url('accountsiswa/ubah_password') ?>" method="post">
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="nameBasic" class="form-label">Password Lama</label>
                                                                <input type="text" name="password" class="form-control" placeholder="Masukan Password Lama..." />

                                                            </div>
                                                        </div>
                                                        <div class="row g-2">
                                                            <div class="col mb-0">
                                                                <label for="emailBasic" class="form-label">Password Baru</label>
                                                                <input type="password" name="password_baru" class="form-control" placeholder="Masukan Passwprd Baru..." />
                                                            </div>
                                                            <div class="col mb-0">
                                                                <label for="dobBasic" class="form-label">Konfirmasi</label>
                                                                <input type="password" name="konfirmasi" class="form-control" placeholder="Masukan Ulang Password..." />
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                        Batal
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-warning" role="alert">Masukan Kombinasi Karakter yang kuat! Min. 7 karakter</div>
                                    <form id="formAccountSettings" action="<?= site_url('accountsiswa/tambah_password') ?>" method="POST">
                                        <div class="row">
                                            <form action="">
                                                <div class="mb-3 col-md-6">
                                                    <label for="lastName" class="form-label">Username</label>
                                                    <input class="form-control" type="text" disabled name="password" value="<?= $user['nama_siswa'] ?>" placeholder="Masukan Password yang kuat ..." />

                                                </div>
                                                <div class="col-md-6">
                                                    <label for="lastName" class="form-label">Password</label>
                                                    <input class="form-control" type="password" <?php if (empty($user['password'])) : ?> name="password" placeholder="Masukan Password yang kuat ..." <?php else : ?> name="password" value="<?= htmlspecialchars($user['password'], ENT_QUOTES, 'UTF-8') ?>" disabled <?php endif; ?> />
                                                </div>

                                        </div>
                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                            <button type="reset" class="btn btn-outline-secondary">Batal</button>
                                        </div>
                                </div>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>