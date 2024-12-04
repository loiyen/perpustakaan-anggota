 <!-- Menu -->

 <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
     <div class="app-brand demo">
         <a href="<?= site_url('dashboard'); ?>" class="app-brand-link">
             <img src="<?php echo base_url('asset/LOGO.png') ?>" width="50" height="50" alt="Logo" class="logo-img img-fluid">
             <h4 class="menu-text fw-bolder ms-2">DASHBOARD SISWA</h4>
         </a>

         <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
             <i class="bx bx-chevron-left bx-sm align-middle"></i>
         </a>
     </div>

     <div class="menu-inner-shadow"></div>

     <ul class="menu-inner py-1">
         <!-- Dashboard -->
         <li class="menu-item">
             <a href="<?= site_url('dashboardsiswa') ?>" class="menu-link">
                 <div data-i18n="Analytics"><i class='bx bx-home' ></i> Dashboard</div>
             </a>
         </li>
         <li class="menu-header small text-uppercase">
             <span class="menu-header-text">Data siswa</span>
         </li>

         <li class="menu-item">
             <a href="<?= site_url('accountsiswa') ?>" class="menu-link ">
                 <div data-i18n="Layouts"> <i class='bx bx-user' ></i> Profil</div>
             </a>
         </li>

         <li class="menu-header small text-uppercase">
             <span class="menu-header-text">Transaksi</span>
         </li>
         <li class="menu-item">
             <a href="<?= site_url('peminjaman') ?>" class="menu-link ">
                 <div data-i18n="Layouts"><i class='bx bxs-up-arrow-alt' style='color:#07f803'></i> Peminjaman</div>
             </a>

         </li>


         <li class="menu-item">
             <a href="<?= site_url('pengembalian') ?>" class="menu-link">
                 <div data-i18n="Layouts"><i class='bx bxs-down-arrow-alt' style='color:#f6041e'></i> Pengembalian</div>
             </a>
         </li>

         <li class="menu-item">
             <a href="<?= site_url('Denda') ?>" class="menu-link ">
                 <div data-i18n="Layouts"><i class='bx bx-wallet-alt'></i> Denda</div>
             </a>
         </li>

         <li class="menu-header small text-uppercase">
             <span class="menu-header-text">Pencarian</span>
         </li>
         <li class="menu-item">
             <a href="<?= site_url('pencarian') ?>" class="menu-link ">
                 <div data-i18n="Layouts"><i class='bx bx-search'></i> Cari buku</div>
             </a>

         </li>
     </ul>
 </aside>
 <!-- / Menu -->