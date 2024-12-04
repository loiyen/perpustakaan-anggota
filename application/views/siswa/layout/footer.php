<footer class="footer bg-light">
    <div class="container-fluid d-flex flex-md-row flex-column justify-content-between align-items-md-center gap-1 container-p-x py-3">
        <div>
            <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/landing/" target="_blank" class="footer-text fw-bolder">SMA N 1 KRAYAN</a>
            ©2024
        </div>
       
    </div>
</footer>
<!-- / Footer -->

<div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
</div>
<!-- / Layout page -->
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>


<!-- / Layout wrapper -->

<div class="buy-now">
    <a href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/" target="_blank" class="btn btn-danger btn-buy-now">Customer Service Web</a>
</div>

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="<?php echo base_url('asset/assets/vendor/libs/jquery/jquery.js') ?>"></script>
<script src="<?php echo base_url('asset/assets/vendor/libs/popper/popper.js') ?>"></script>
<script src="<?php echo base_url('asset/assets/vendor/js/bootstrap.js') ?>"></script>
<script src="<?php echo base_url('asset/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') ?>"></script>

<script src="<?php echo base_url('asset/assets/vendor/js/menu.js') ?>"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="<?php echo base_url('asset/assets/vendor/libs/apex-charts/apexcharts.js') ?>"></script>

<!-- Main JS -->
<script src="<?php echo base_url('asset/assets/js/main.js') ?>"></script>

<!-- Page JS -->
<script src="<?php echo base_url('asset/assets/js/dashboards-analytics.js') ?>"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<script src="<?php echo base_url('asset/assets/js/js/sweetalert2.all.min.js') ?>"></script>
<script src="<?php echo base_url('asset/assets/js/myjs') ?>"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if ($this->session->flashdata('success')) { ?>
        var isi = <?php echo json_encode($this->session->flashdata('success')) ?>;
        Swal.fire({
            title: 'Berhasil! ',
            text: isi,
            icon: 'success',
        })
    <?php } ?>
</script>

<script>
    $(document).on('click', '#btn-hapus', function(e) {
        e.preventDefault();
        var link = $(this).attr('href');
        Swal.fire({
            title: "Apakah Anda Yakin?",
            text: "Data akan dihapus!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = link;
            }
        });
    })
</script>






</body>

</html>