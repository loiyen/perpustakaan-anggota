<nav class="navbar navbar-example navbar-expand-lg bg-white">
    <div class="container-fluid">
        <a class="navbar-brand" href="javascript:void(0)">
            <img src="<?= base_url('asset/LOGO.png') ?>" alt="Logo" style="height: 40px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-4">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbar-ex-4">
            <div class="navbar-nav text-center">
                <a class="nav-item nav-link " href="<?= site_url('beranda') ?>">Beranda</a>
                <a class="nav-item nav-link" href="<?= site_url('buku') ?>">Buku</a>
                <a class="nav-item nav-link" href="javascript:void(0)">Tentang Kami</a>
            </div>
            <form class="d-flex ms-auto">
                <div class="input-group">
                    <div class="navbar-nav">
                        <a href="<?= site_url('siswapanel') ?>" class="nav-item nav-link text-center"><i class='bx bx-log-in'></i> Login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</nav>