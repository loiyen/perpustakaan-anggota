<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengembalian extends CI_Controller
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

        $config['total_rows'] = $this->msiswa->countDatariwayatpengembalian($id);
        // var_dump($config['total_rows']);
        // die;
        $config['per_page'] = 15;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);
        $page = $this->uri->segment(3) ? $this->uri->segment(3) : 1;


        $offset = ($page - 1) * $config['per_page'];
        $data['pengembalian'] = $this->msiswa->get_all_riwayatpengembalian($id, $config['per_page'], $offset);
        $data['total_pages'] = ceil($config['total_rows'] / $config['per_page']);


        $data['current_page'] = $page;
        $data['pagination'] = $this->pagination->create_links();

        $data['title'] = 'Pengembalian Siswa';
        $this->load->view('siswa/layout/header', $data);
        $this->load->view('siswa/layout/sidebar');
        $this->load->view('siswa/pengembaliansiswa/daftar_pengembalian', $data);
        $this->load->view('siswa/layout/footer');
    }
    public function detail_pengembalian($id)
    {
        if (!$this->session->userdata('session_siswa') || empty($this->session->userdata('session_siswa')['id_siswa'])) {
            redirect('siswapanel');
        }

        $id_siswa = $this->session->userdata('session_siswa')['id_siswa'];
        $data['user'] = $this->db->get_where('tbl_siswa', ['id_siswa' => $id_siswa])->row_array();

        $data['pengembalian'] = $this->msiswa->pengembalian($id);
        $data['detail_pengembalian'] = $this->msiswa->detail_pengembalian($id);
        $data['pembayaran'] = $this->msiswa->get_pembayaran($id);
        // var_dump( $data['pembayaran']);
        // die;


        $data['title'] = 'Detail Pengembalian';
        $this->load->view('siswa/layout/header', $data);
        $this->load->view('siswa/layout/sidebar');
        $this->load->view('siswa/pengembaliansiswa/detail_pengembalian', $data);
        $this->load->view('siswa/layout/footer');
    }
}
