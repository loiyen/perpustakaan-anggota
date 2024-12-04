<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Layout container -->
        <div class="layout-page">

            <?php
            $this->load->view('siswa/layout/navbar');
            ?>

            <div class="content-wrapper">
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">

                    <div class="row mb-2">
                        <div class="col-md-12 mb-2">
                            <div class="card">
                                <div class="card-header">
                                    <a href="<?= site_url('peminjaman') ?>" class="btn btn-outline-warning"><i class='bx bx-left-arrow-alt'></i> Kembali</a>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card">
                                        <h6 class="card-header"><strong>Daftar Buku Peminjaman</strong></h6>
                                        <div class="card-body">
                                            <div class="table-responsive text-nowrap">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Judul</th>
                                                            <th>Jumlah</th>
                                                            <th>Tanggal Peminjaman</th>
                                                            <th>Tanggal Pengembalian</th>
                                                            <th>Denda</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-border-bottom-0">
                                                        <?php
                                                        if (empty($detail_items)) {
                                                            echo "<tr><td colspan='8' class='text-center mt-3 mb-3'>Tidak ada data yang ditemukan.</td></tr>";
                                                        } else {
                                                            $no = 1;
                                                            foreach ($detail_items as $val) { ?>
                                                                <tr>
                                                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i><?= $no; ?></td>
                                                                    <td><?= $val->judul_buku; ?></td>
                                                                    <td><?= $val->jumlah_pinjam; ?></td>
                                                                    <td><?= format_tanggal_indonesia($val->tanggal_pinjam); ?></td>
                                                                    <td><?= format_tanggal_indonesia($val->tanggal_kembali); ?></td>
                                                                    <td><?= rupiah_format($val->denda); ?></td>
                                                                    <td>
                                                                        <?php
                                                                        if ($val->status == 'Belum Kembali') {
                                                                            echo '<span class="badge bg-label-primary me-1"><strong>' . $val->status . '</strong></span>';
                                                                        } else if ($val->status == 'Terlambat') {
                                                                            echo '<span class="badge bg-label-danger me-1"><strong>' . $val->status . '</strong></span>';
                                                                        } else {
                                                                            echo '<span class="badge bg-label-success me-1"><strong>' . $val->status . '</strong></span>';
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                            <?php $no++;
                                                            } ?>
                                                        <?php }; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <?php
                                        foreach ($detail_items as $val) :
                                        ?>
                                            <div class="col-md-6 mb-2">
                                                <div class="card h-100">
                                                    <div class="col-md">
                                                        <div class="row g-0">
                                                            <div class="col-md-4">
                                                                <img class="card-img card-img-left" src="<?= base_url('asset/fotobuku/' . $val->foto_buku) ?>" alt="Card image" />
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="card-body">
                                                                    <h6 class="card-title"><?= $val->judul_buku; ?></h6>
                                                                    <p class="card-text mb-0">
                                                                        <small class="text-muted">
                                                                            Kelas : <?= $val->kelas_buku ?>
                                                                        </small>
                                                                    </p>
                                                                    <p class="card-text mb-0">
                                                                        <small class="text-muted">
                                                                            Penerbit : <?= $val->penerbit_buku ?>
                                                                        </small>
                                                                    </p>
                                                                    <p class="card-text"> <small class="text-muted"> Stok : <?= $val->stok_buku; ?></small></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <h6 class="card-header"> <strong>Data Peminjaman</strong></h6>
                                        <div class="card-body">
                                            <div class="table-responsive text-nowrap">
                                                <table class="table-responsive text-nowrap">
                                                    <table class="table table-borderless">
                                                        <thead>
                                                            <tr>
                                                                <td> <strong>Kode Peminjaman</strong></td>
                                                                <td>:</td>
                                                                <td> <strong><?= $detail_peminjaman['kode_peminjaman']; ?></strong></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Jumlah</td>
                                                                <td>:</td>
                                                                <td><?= $detail_peminjaman['total_peminjaman']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Status</td>
                                                                <td>:</td>
                                                                <td><?php
                                                                    if ($detail_peminjaman['status_pinjam'] == 'Selesai') {
                                                                        echo '<span class="badge bg-success me-1"><strong>' . $detail_peminjaman['status_pinjam'] . '</strong></span>';
                                                                    } else {
                                                                        echo '<span class="badge bg-danger"><strong>' . $detail_peminjaman['status_pinjam'] . '</strong></span>';
                                                                    }
                                                                    ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Admin</td>
                                                                <td>:</td>
                                                                <td><?= $detail_peminjaman['nama_admin']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Tanggal & Jam</td>
                                                                <td>:</td>
                                                                <td><?= format_tanggal_indonesia($detail_peminjaman['date_pinjam']) ?> | <?= format_jam_indonesia($detail_peminjaman['date_pinjam']) ?></td>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row mb-5 mt-5">
                        <?php
                        foreach ($detail_items as $val) : ?>

                            <!-- <div class="col-md">
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img class="card-img card-img-left" src="<?= base_url('asset/fotobuku/' . $val->foto_buku) ?>" alt="Card image" />
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $val->kode_buku; ?> / <?= $val->judul_buku; ?> </h5>
                                                <p class="card-text">
                                                    kelas : <?= $val->kelas_buku ?>
                                                </p>
                                                <p class="card-text">
                                                    Pernerbit : <?= $val->penerbit_buku ?>
                                                </p>
                                                <p class="card-text">
                                                    Stok : <?= $val->stok_buku; ?>
                                                </p>
                                                <a href="<?= site_url('buku/detail_Buku/' . $val->id_buku) ?>" class="card-link">Lihat Data</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        <?php endforeach; ?>
                    </div>
                </div>