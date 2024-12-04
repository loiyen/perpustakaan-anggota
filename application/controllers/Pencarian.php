<?php

use PhpParser\ErrorHandler\Throwing;

defined('BASEPATH') or exit('No direct script access allowed');

class Pencarian extends CI_Controller
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

        $data['kategori'] = $this->msiswa->get_kategori();
        $data['rak'] = $this->msiswa->get_rak();

        $data['title'] = 'Pencarian buku';
        $this->load->view('siswa/layout/header', $data);
        $this->load->view('siswa/layout/sidebar');
        $this->load->view('siswa/pencarian/pencarian_buku', $data);
        $this->load->view('siswa/layout/footer');
    }

    public function detail_buku($id)
    {
        if (!$this->session->userdata('session_siswa') || empty($this->session->userdata('session_siswa')['id_siswa'])) {
            redirect('siswapanel');
        }

        $id_siswa = $this->session->userdata('session_siswa')['id_siswa'];
        $data['user'] = $this->db->get_where('tbl_siswa', ['id_siswa' => $id_siswa])->row_array();

        $data['kategori'] = $this->msiswa->get_kategori();
        $data['rak'] = $this->msiswa->get_rak();
        $data['buku'] = $this->msiswa->get_detailbuku($id);

        $data['buku_detail'] = $this->msiswa->get_bukudetail();

        $data['title'] = 'Detail buku';
        $this->load->view('siswa/layout/header', $data);
       
        $this->load->view('siswa/pencarian/detail_buku', $data);
        $this->load->view('siswa/layout/footer');
    }

    public function pencarian_buku()
    {
        if (!$this->session->userdata('session_siswa') || empty($this->session->userdata('session_siswa')['id_siswa'])) {
            redirect('siswapanel');
        }

        $id_siswa = $this->session->userdata('session_siswa')['id_siswa'];
        $data['user'] = $this->db->get_where('tbl_siswa', ['id_siswa' => $id_siswa])->row_array();

        $kyword = $this->input->get('kyword');
        $data['kyword'] = $kyword;
        $data['buku'] = $this->msiswa->get_pencarian($kyword);

        $data['kategori'] = $this->msiswa->get_kategori();
        $data['rak'] = $this->msiswa->get_rak();

        $data['title'] = 'Pencarian buku';
        $this->load->view('siswa/layout/header', $data);
        $this->load->view('siswa/layout/sidebar');
        $this->load->view('siswa/pencarian/pencarian', $data);
        $this->load->view('siswa/layout/footer');
    }

    public function kategori_buku($id)
    {
        if (!$this->session->userdata('session_siswa') || empty($this->session->userdata('session_siswa')['id_siswa'])) {
            redirect('siswapanel');
        }

        $id_siswa = $this->session->userdata('session_siswa')['id_siswa'];
        $data['user'] = $this->db->get_where('tbl_siswa', ['id_siswa' => $id_siswa])->row_array();

        $config['base_url'] = site_url('buku/kategori_buku/' . $id);
        $config['total_rows'] = $this->msiswa->countDatabukukategori($id);
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);
        $page = $this->uri->segment(4) ? $this->uri->segment(4) : 1;

        $offset = ($page - 1) * $config['per_page'];
        $data['id'] = $id;
        $data['buku'] = $this->msiswa->get_buku_bykategori($config['per_page'], $offset, $id);

        $data['total_pages'] = ceil($config['total_rows'] / $config['per_page']);
        $data['current_page'] = $page;
        $data['pagination'] = $this->pagination->create_links();

        $data['kategori'] = $this->msiswa->get_kategori();
        $data['rak'] = $this->msiswa->get_rak();

        $data['title'] = 'Kategori buku';
        $this->load->view('siswa/layout/header', $data);
        $this->load->view('siswa/layout/sidebar');
        $this->load->view('siswa/pencarian/kategori_buku', $data);
        $this->load->view('siswa/layout/footer');
    }



    public function filter_buku()
    {
        if (!$this->session->userdata('session_siswa') || empty($this->session->userdata('session_siswa')['id_siswa'])) {
            redirect('siswapanel');
        }

        $id_siswa = $this->session->userdata('session_siswa')['id_siswa'];
        $data['user'] = $this->db->get_where('tbl_siswa', ['id_siswa' => $id_siswa])->row_array();

        $kelas = $this->input->get('kelas');
        $rak = $this->input->get('rak');

        $config['base_url'] = site_url('buku/filter_buku/') . '?' . http_build_query(['kelas' => $kelas, 'rak' => $rak]);
        $config['total_rows'] = $this->msiswa->countFilteredDatabuku($kelas, $rak);
        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';

        $this->pagination->initialize($config);
        $page = $this->input->get('page') ? $this->input->get('page') : 1;

        $offset = ($page - 1) * $config['per_page'];

        $data['total_pages'] = ceil($config['total_rows'] / $config['per_page']);
        $data['current_page'] = $page;
        $data['pagination'] = $this->pagination->create_links();

        $data['kategori'] = $this->msiswa->get_kategori();
        $data['rak'] = $this->msiswa->get_rak();

        $data['buku'] = $this->msiswa->filter_buku($config['per_page'], $offset, $kelas, $rak);

        $data['title'] = 'Pencarian Buku';
        $data['kelas'] = $kelas;
        $data['rak_filter'] = $rak;

        $data['title'] = 'Filter buku';
        $this->load->view('siswa/layout/header', $data);
        $this->load->view('siswa/layout/sidebar');
        $this->load->view('siswa/pencarian/filter_buku', $data);
        $this->load->view('siswa/layout/footer');
    }

    public function filter()
    {
        if (!$this->session->userdata('session_siswa') || empty($this->session->userdata('session_siswa')['id_siswa'])) {
            redirect('siswapanel');
        }

        $id_siswa = $this->session->userdata('session_siswa')['id_siswa'];
        $data['user'] = $this->db->get_where('tbl_siswa', ['id_siswa' => $id_siswa])->row_array();

        $kelas = $this->input->post('kelas');
        $rak = $this->input->post('rak');

        $query = http_build_query(['kelas' => $kelas, 'rak' => $rak]);

        redirect('pencarian/filter_buku?' . $query);
    }

    public function pengurutan()
    {
        if (!$this->session->userdata('session_siswa') || empty($this->session->userdata('session_siswa')['id_siswa'])) {
            redirect('siswapanel');
        }

        $id_siswa = $this->session->userdata('session_siswa')['id_siswa'];
        $data['user'] = $this->db->get_where('tbl_siswa', ['id_siswa' => $id_siswa])->row_array();

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

        $data['kategori'] = $this->msiswa->get_kategori();
        $data['rak'] = $this->msiswa->get_rak();

        $data['title'] = 'Pengurutan buku';
        $this->load->view('siswa/layout/header', $data);
        $this->load->view('siswa/layout/sidebar');
        $this->load->view('siswa/pencarian/urut_buku', $data);
        $this->load->view('siswa/layout/footer');
    }
}
