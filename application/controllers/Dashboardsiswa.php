<?php

use PhpParser\ErrorHandler\ThrowingTest;

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboardsiswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('msiswa');
    }

    public function index()
    {
        if (!$this->session->userdata('session_siswa') || empty($this->session->userdata('session_siswa')['id_siswa'])) {
            redirect('siswapanel');
        }

        $id_siswa = $this->session->userdata('session_siswa')['id_siswa'];
        $data['user'] = $this->db->get_where('tbl_siswa', ['id_siswa' => $id_siswa])->row_array();

        $id = $data['user']['id_siswa'];

        $config['total_rows'] = $this->msiswa->countDatariwayatpeminjaman($id);
        $config['per_page'] = 15;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);
        $page = $this->uri->segment(3) ? $this->uri->segment(3) : 1;


        $offset = ($page - 1) * $config['per_page'];
        $data['riwayat'] = $this->msiswa->get_data_peminjaman($id, $config['per_page'], $offset);
        $data['total_pages'] = ceil($config['total_rows'] / $config['per_page']);


        $data['current_page'] = $page;
        $data['pagination'] = $this->pagination->create_links();


        $data['peminjamanitem'] = $this->msiswa->hitung_jumlahpinjam($id);
        $data['pengembalian'] = $this->msiswa->hitung_jumlahkembali($id);
        $data['jumlah'] = $this->msiswa->hitung_pembayaran($id);
        $data['total_denda'] = $this->msiswa->hitung_denda($id);
        $data['cek_buku'] = $this->msiswa->cek_kembali_buku($id);
        // var_dump($data['cek_buku']);
        // die;

        $data['title'] = 'Dashboard siswa';
        $this->load->view('siswa/layout/header', $data);
        $this->load->view('siswa/layout/sidebar');
        $this->load->view('siswa/dashboard', $data);
        $this->load->view('siswa/layout/footer');
    }

    public function cari_data_peminjaman()
    {
        if (!$this->session->userdata('session_siswa') || empty($this->session->userdata('session_siswa')['id_siswa'])) {
            redirect('siswapanel');
        }

        $id_siswa = $this->session->userdata('session_siswa')['id_siswa'];
        $data['user'] = $this->db->get_where('tbl_siswa', ['id_siswa' => $id_siswa])->row_array();

        $kyword = $this->input->get('keyword');
        $data['key'] =  $kyword;
        $data['data_pencarian'] = $this->msiswa->get_data_pencarian($kyword);
        $id_peminjaman =  $data['data_pencarian']['id_peminjaman'];

        $data['detail_items'] = $this->msiswa->get_detail_peminjamanitems($id_peminjaman);
        $data['detail_peminjaman'] = $this->msiswa->get_detail_peminjaman($id_peminjaman);

        $data['title'] = 'Detail Peminjaman';
        $this->load->view('siswa/layout/header', $data);
        $this->load->view('siswa/layout/sidebar');
        $this->load->view('siswa/peminjamansiswa/detail_riwayat_peminjaman', $data);
        $this->load->view('siswa/layout/footer');
    }

    public function logout()
    {
        $this->session->unset_userdata('session_siswa');

        $this->session->set_flashdata('not', '<div class="alert alert-success alert-dismissible fade show" role="alert">
		<strong>Berhasil!</strong> Anda Berhasil Keluar.
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	  </div>');
        redirect('beranda');
    }
}
