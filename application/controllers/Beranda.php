<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('msiswa');
    }

    public function index()
    {
        $config['total_rows'] = $this->msiswa->countDatabuku();
        $config['per_page'] = 15;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);
        $page = $this->uri->segment(3) ? $this->uri->segment(3) : 1;



        $offset = ($page - 1) * $config['per_page'];

        $data['buku'] = $this->msiswa->get_buku($config['per_page'], $offset);
        $data['total_pages'] = ceil($config['total_rows'] / $config['per_page']);

        $data['current_page'] = $page;
        $data['pagination'] = $this->pagination->create_links();

        $data['total'] = $this->msiswa->countDatabuku();
        $data['total_anggota'] = $this->msiswa->hitung_siswa();
        $data['total_admin'] = $this->msiswa->hitung_admin();
        $data['total_kategori'] = $this->msiswa->hitung_kategori();

        $data['title'] = 'Beranda';
        $this->load->view('siswa/layout/header', $data);
        $this->load->view('lendingpg/beranda/beranda', $data);
        $this->load->view('siswa/layout/footer');
    }
    public function pengurutan()
    {
        $config['total_rows'] = $this->msiswa->countDatabuku();
        $config['per_page'] = 15;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);
        $page = $this->uri->segment(3) ? $this->uri->segment(3) : 1;

        $offset = ($page - 1) * $config['per_page'];

        $urutan = $this->input->get('urutan');
        $data['urutan'] = $urutan;
        $data['buku'] = $this->msiswa->urut_buku($config['per_page'], $offset, $urutan);

        // var_dump($data['buku']);
        // die;
        $data['total_pages'] = ceil($config['total_rows'] / $config['per_page']);

        $data['current_page'] = $page;
        $data['pagination'] = $this->pagination->create_links();

      
        $data['total'] = $this->msiswa->countDatabuku();
        $data['total_anggota'] = $this->msiswa->hitung_siswa();
        $data['total_admin'] = $this->msiswa->hitung_admin();
        $data['total_kategori'] = $this->msiswa->hitung_kategori();

        $data['title'] = 'Beranda';
        $this->load->view('siswa/layout/header', $data);
        $this->load->view('lendingpg/beranda/beranda', $data);
        $this->load->view('siswa/layout/footer');
    }
}
