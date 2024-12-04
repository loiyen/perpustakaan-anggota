<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <?php
                $this->load->view('siswa/layout/navbar_page');
                ?>

                <div class="row mt-1">
                    <div class="col-md-12 mb-1">
                        <div class="row ml-lg-2 mt-2 mb-2">
                            <?php
                            foreach ($kategori as $val) :
                            ?>
                                <div class="col-md-3 col-sm-3 col-lg-3 mb-1">
                                    <div class="card">
                                        <a class="card-header text-dark" href="<?= site_url('buku/kategori_buku/' . $val->id_kategori) ?>"><i class='bx bxs-book'></i> <?= $val->nama_kategori; ?></a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3 col-sm-12">
                        <form action="<?= site_url('buku/filter') ?>" method="post">
                            <div class="card mb-1">
                                <div class="card-body">
                                    <h5 class="card-header">Daftar Buku Perpustakan</h5>
                                </div>
                            </div>
                            <div class="card mb-1">
                                <h6 class="card-header fw-bold">Filter Kelas</h6>
                                <div class="card-body">
                                    <select id="defaultSelect" class="form-select" name="kelas">
                                        <option disabled selected hidden>Pilih Kelas Buku --</option>
                                        <option value="X">X</option>
                                        <option value="XI">XI</option>
                                        <option value="XII">XII</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card mb-1">
                                <h6 class="card-header fw-bold">Filter Rak Buku</h6>
                                <div class="card-body">
                                    <select id="defaultSelect" class="form-select" name="rak">
                                        <option disabled selected hidden>Pilih Rak Buku --</option>
                                        <?php
                                        foreach ($rak as $val) : ?>
                                            <option value="<?= $val->id_rak; ?>"> <?= $val->nama_rak; ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="card mb-1">
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="col-md-9 mb-1">
                        <div class="row">
                            <div class="col-md-8 col-lg-8 col-sm-8 mb-1">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="<?= site_url("buku/pencarian_buku") ?>" method="get">
                                            <div class="input-group input-group-merge">
                                                <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bx-search'></i></span>
                                                <input type="text" class="form-control" name="kyword" placeholder="Cari buku disini" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="<?= site_url('buku/pengurutan') ?>" method="get">
                                            <div class="d-flex align-items-center justify-content-between ">
                                                <select id="defaultSelect" class="form-select " name="urutan">
                                                    <option disabled selected hidden>Urutkan Buku --</option>
                                                    <option value="1">Populer</option>
                                                    <option value="2">Terbaru</option>
                                                    <option value="3">Lama</option>
                                                </select>
                                                <button type="submit" class="btn btn-primary"><i class='bx bx-send'></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <?php
                                    if (empty($buku)) {
                                    ?>
                                        <div class="col-md-12 text-center col-lg-12 mb-1 mt-1">
                                            <div class="card">
                                                <div class="card-body pb-0 px-0 px-md-4 mt-5">
                                                    <img src="<?= base_url('asset/assets/img/illustrations/girl-doing-yoga-light.png'); ?>" height="190" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                                                    <h6 class="card-header">Tidak ada data yang ditemukan</h6>
                                                    <?php
                                                    if (empty($kyword)) {
                                                        echo '';
                                                    } else {
                                                        echo ' <h6 class="card-title mb-5">--- Pencarian <i>" ' . $kyword . ' "</i> ---</h6>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    } else {
                                        foreach ($buku as $val) :
                                        ?>
                                            <div class="col-md-6 col-lg-3 col-sm-6 mb-1 mt-1">
                                                <div class="card h-100">
                                                    <img class="card-img-top w-70 h-50" src="<?= base_url('asset/fotobuku/IPS_BS_KLS_X_Rev_Cover.png') ?>" alt="Card image cap" />
                                                    <div class="card-body mb-0">
                                                        <span class="badge bg-danger"><?= $val->kelas_buku; ?></span>
                                                        <span class="badge bg-info"><?= $val->tahun_penerbit; ?></span>
                                                        <p class=" fw-bold"><?= $val->judul_buku; ?></p>
                                                        <small class="text-muted"><i class='bx bxs-edit'></i> <?= $val->penulis_buku; ?></small>
                                                    </div>
                                                    <div class="card-footer">
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
                                                            <a class="page-link" href="<?= base_url('index.php/buku/index/' . ($current_page - 1)) ?>"><i class="tf-icon bx bx-chevrons-left"></i></a>
                                                        </li>
                                                        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                                            <li class="page-item <?= $i == $current_page ? 'active' : '' ?>">
                                                                <a class="page-link" href="<?= base_url('index.php/buku/index/' . $i) ?>"><?= $i ?></a>
                                                            </li>
                                                        <?php endfor; ?>
                                                        <li class="page-item next">
                                                            <a class="page-link" href="<?= base_url('index.php/buku/index/' . ($current_page + 1)) ?>"><i class="tf-icon bx bx-chevrons-right"></i></a>
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