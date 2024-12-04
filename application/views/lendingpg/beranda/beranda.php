<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <?php
                $this->load->view('siswa/layout/navbar_page');
                ?>
                <div class="row mt-2">
                    <div class="col-md-6 col-lg-6 col-sm">
                        <div class="card h-100 ">
                            <div class="card-body ">
                                <h3 class="card-header">SELAMAT DATANG <br><strong>PERPUSTAKAAN SMA N 1 KRAYAN</strong></h3>
                                <div class="card-body">
                                    <p class="col-lg-12 col-md-12 card-title">Merupakan Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took
                                        a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                                    </p>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-4 col-lg-4 col-sm-12 ">
                                        <div class="card-body pb-0 px-0 px-md-4 mt-5">
                                            <img class="card-img-top w-100 h-100" src="<?= base_url('asset/assets/img/illustrations/man-with-laptop-light.png'); ?>" width="" height="100" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-8 col-sm-12 ">
                                        <h6 class="card-header fw-bold text-center">PERPUSTAKAAN SMA N 1 KRAYAN</h6>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 mb-2">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h6 class="card-title"><i class='bx bxs-book' style='color:#00a4d2'></i> BUKU</h6>
                                                            <h4 class="card-text text-center">
                                                                <?= $total; ?>
                                                            </h4>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 mb-2">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h6 class="card-title"><i class='bx bxs-user' style='color:#4504c7'></i> ANGGOTA</h6>
                                                            <h4 class="card-text text-center">
                                                                <?= $total_anggota; ?>
                                                            </h4>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 mb-2">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h6 class="card-title"><i class='bx bxs-user-rectangle' style='color:#9c0890'></i> PETUGAS</h6>
                                                            <h4 class="card-text text-center">
                                                                <?= $total_admin; ?>
                                                            </h4>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 mb-2">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h6 class="card-title"><i class='bx bxs-user-rectangle' style='color:#9c0890'></i> KATEGORI</h6>
                                                            <h4 class="card-text text-center">
                                                                <?= $total_kategori; ?>
                                                            </h4>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="card ">

                            <div id="carouselExample" class="carousel slide card" data-bs-ride="carousel">
                                <div class="carousel-inner ">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100 h-100" src="<?= base_url('asset/assets/img/elements/13.jpg') ?>" alt="First slide" />
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100 h-100" src="<?= base_url('asset/assets/img/elements/2.jpg') ?>" alt="Second slide" />

                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100 h-100" src="<?= base_url('asset/assets/img/elements/18.jpg') ?>" alt="Third slide" />

                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>

                                </a>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-12 mb-1">
                        <div class="card">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h6 class="mb-0">Daftar Buku Perpustakaan </h6>
                                <span><i class='bx bxs-book-alt'></i> <?= $total; ?></span>
                                <small class="text-muted float-end">
                                    <form action="<?= site_url('beranda/pengurutan') ?>" method="get">
                                        <div class="d-flex align-items-center justify-content-between ">
                                            <select id="defaultSelect" class="form-select btn-sm" name="urutan">
                                                <option disabled selected hidden>Urutkan Buku --</option>
                                                <option value="1">Populer</option>
                                                <option value="2">Terbaru</option>
                                                <option value="3">Lama</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-sm"><i class='bx bx-send'></i></button>
                                        </div>
                                    </form>
                                </small>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <?php
                        if (empty($urutan)) {
                        } else {
                            if ($urutan == 1) {
                                echo '<h6 class="card-header text-center">-- Berdasarkan " <i> Populer </i>" --</h6>';
                            } elseif ($urutan == 2) {
                                echo '<h6 class="card-header text-center">-- Berdasarkan " <i> Terbaru </i>" --</h6>';
                            } else {
                                echo '<h6 class="card-header text-center">-- Berdasarkan " <i> Lama </i>" --</h6>';
                            }
                        }
                        ?>
                        <div class="row">
                            <?php
                            if (empty($buku)) {
                                echo '<div class="col-md-12 text-center col-lg-12 mb-1 mt-1">
                                            <div class="card">
                                                <h6 class="card-header">Tidak ada data yang ditemukan</h6>
                                            </div>
                                        </div>';
                            } else {
                                foreach ($buku as $val) :
                            ?>
                                    <div class="col-md-3 col-lg-2 col-sm-4 mb-1 mt-1">
                                        <div class="card h-100">
                                            <img class="card-img-top w-70 h-50" src="<?= base_url('asset/fotobuku/IPS_BS_KLS_X_Rev_Cover.png') ?>" alt="Card image cap" />
                                            <div class="card-body h-30 mb-0">
                                                <span class="badge bg-danger"><?= $val->kelas_buku; ?></span>
                                                <span class="badge bg-info"><?= $val->tahun_penerbit; ?></span>
                                                <p class=" fw-bold"><?= $val->judul_buku; ?></p>
                                                <small class="text-muted"><i class='bx bxs-edit'></i> <?= $val->penulis_buku; ?></small>
                                            </div>
                                            <div class="card-footer ">
                                                <a href="<?= site_url('buku/detail_buku/' . $val->id_buku) ?>" class="btn btn-sm btn-primary">Lihat detail <i class='bx bx-right-arrow-alt'></i></a>
                                            </div>
                                        </div>
                                    </div>
                            <?php endforeach;
                            } ?>
                        </div>
                        <div class="col-md-12 align-content-center">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h6 class="mb-0"></h6>
                                <span>
                                    <div class="demo-inline-spacing">
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination pagination">
                                                <li class="page-item prev">
                                                    <a class="page-link" href="<?= base_url('index.php/beranda/index/' . ($current_page - 1)) ?>"><i class="tf-icon bx bx-chevrons-left"></i></a>
                                                </li>
                                                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                                    <li class="page-item <?= $i == $current_page ? 'active' : '' ?>">
                                                        <a class="page-link" href="<?= base_url('index.php/beranda/index/' . $i) ?>"><?= $i ?></a>
                                                    </li>
                                                <?php endfor; ?>
                                                <li class="page-item next">
                                                    <a class="page-link" href="<?= base_url('index.php/beranda/index/' . ($current_page + 1)) ?>"><i class="tf-icon bx bx-chevrons-right"></i></a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </span>

                                <small class="text-muted float-end"></small>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>