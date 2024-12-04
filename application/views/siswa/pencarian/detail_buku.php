<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="<?= site_url('pencarian') ?>" class="btn btn-outline-warning"><i class='bx bx-left-arrow-alt'></i> Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-lg-12">
                        <div class="card-body">
                            <nav aria-label="breadcrumb mt-5">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="javascript:void(0);">Buku</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="javascript:void(0);">Detail Buku</a>
                                    </li>
                                    <li class="breadcrumb-item active"> <?= $buku['judul_buku']; ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 ">
                                        <div class="card-body">
                                            <img class="card-img-top w-100 h-100" src="<?= URL_IMG . $buku['foto_buku'] ?>" alt="">
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8">
                                        <div class="card-body">
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $buku['judul_buku'] ?></h5>
                                                <p class="card-text">
                                                    Buku ini merupakan aset / arsip perpustakan yang tidak boleh <strong>dihilangkan / dirusak </strong> jika terdapat kerusakan / penghilangan secara senggaja, maka yang bersangkutan akan dikenakan <strong>Denda / Hukuman </strong> 
                                                    sesuai Aturan dan Kebijakan yang ada.
                                                </p>
                                            </div>
                                            <div class="card-body">
                                                <div class="row mb-4">
                                                    <div class="col-md-3">
                                                        <h5 class="card-title fw-normal">DETAIL BUKU</h5>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <hr>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4 col-lg-4 col-sm-4 mb-2">
                                                        <h5 class="card-title fw-bold">Penerbit</h5>
                                                        <p class="card-text">
                                                            <?= $buku['penerbit_buku']; ?>
                                                        </p>
                                                    </div>
                                                    <div class="col-md-4 col-lg-4 col-sm-4  mb-2">
                                                        <h5 class="card-title fw-bold">ISBN</h5>
                                                        <p class="card-text">
                                                            <?= $buku['isbn']; ?>
                                                        </p>
                                                    </div>
                                                    <div class="col-md-4 col-lg-4 col-sm-4 mb-2">
                                                        <h5 class="card-title fw-bold">Penulis</h5>
                                                        <p class="card-text">
                                                            <?= $buku['penulis_buku']; ?>
                                                        </p>
                                                    </div>
                                                    <div class="col-md-4 col-lg-4 col-sm-4 mb-2">
                                                        <h5 class="card-title fw-bold">Kelas</h5>
                                                        <p class="card-text">
                                                            <?= $buku['kelas_buku']; ?>
                                                        </p>
                                                    </div>
                                                    <div class="col-md-4 col-lg-4 col-sm-4 mb-2">
                                                        <h5 class="card-title fw-bold">Tahun</h5>
                                                        <p class="card-text">
                                                            <?= $buku['tahun_penerbit']; ?>
                                                        </p>
                                                    </div>
                                                    <div class="col-md-4 col-lg-4 col-sm-4 mb-2">
                                                        <h5 class="card-title fw-bold">Stok</h5>
                                                        <p class="card-text">
                                                            <?= $buku['stok_buku']; ?>
                                                        </p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 mt-2">
                        <div class="card">
                            <div class="row">
                                <div class="col-lg-2">
                                    <h5 class="card-header fw-normal">DAFTAR BUKU</h5>
                                </div>
                                <div class="col-lg-10">
                                    <div class="card-header">
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="row">
                            <?php
                            if (empty($buku_detail)) {
                            } else {
                                foreach ($buku_detail as $val) : ?>
                                    <div class="col-md-3 col-lg-2 col-sm-4 mb-1 mt-1">
                                        <div class="card h-100">
                                            <img class="card-img-top w-70 h-50" src="<?= URL_IMG . $val->foto_buku ?>" alt="Card image cap" />
                                            <div class="card-body mb-0">
                                                <span class="badge bg-danger"><?= $val->kelas_buku; ?></span>
                                                <span class="badge bg-info"><?= $val->tahun_penerbit; ?></span>
                                                <p class=" fw-bold"><?= $val->judul_buku; ?></p>
                                                <small class="text-muted"><i class='bx bxs-edit'></i> <?= $val->penulis_buku; ?></small>
                                            </div>
                                            <div class="card-footer">
                                                <a href="<?= site_url('pencarian/detail_buku/' . $val->id_buku) ?>" class="btn btn-sm btn-primary">Lihat detail <i class='bx bx-right-arrow-alt'></i></a>
                                            </div>
                                        </div>
                                    </div>
                            <?php endforeach;
                            } ?>
                        </div>
                    </div>
                </div>
            </div>