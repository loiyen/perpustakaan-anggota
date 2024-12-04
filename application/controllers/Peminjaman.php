<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peminjaman extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('msiswa');
        $this->load->model('madmin');
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

        $config['per_page'] = 20;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);
        $page = $this->uri->segment(3) ? $this->uri->segment(3) : 1;


        $offset = ($page - 1) * $config['per_page'];
        $data['riwayat'] = $this->msiswa->get_data_peminjaman($id, $config['per_page'], $offset);
        $data['total_pages'] = ceil($config['total_rows'] / $config['per_page']);

       
        $data['current_page'] = $page;
        $data['pagination'] = $this->pagination->create_links();

        $data['title'] = 'Peminjaman siswa';
        $this->load->view('siswa/layout/header', $data);
        $this->load->view('siswa/layout/sidebar');
        $this->load->view('siswa/peminjamansiswa/daftar_peminjaman', $data);
        $this->load->view('siswa/layout/footer');
    }

    public function peminjamanitem($id)
    {
        if (!$this->session->userdata('session_siswa') || empty($this->session->userdata('session_siswa')['id_siswa'])) {
            redirect('siswapanel');
        }

        $id_siswa = $this->session->userdata('session_siswa')['id_siswa'];
        $data['user'] = $this->db->get_where('tbl_siswa', ['id_siswa' => $id_siswa])->row_array();

        $kyword = $this->input->get('keyword');
        $data['key'] =  $kyword;

        $data['detail_items'] = $this->msiswa->get_detail_peminjamanitems($id);

        $data['detail_peminjaman'] = $this->msiswa->get_detail_peminjaman($id);
        // var_dump($data['detail_peminjaman']);
        // die;
        $data['title'] = 'Detail Peminjaman';
        $this->load->view('siswa/layout/header', $data);
        $this->load->view('siswa/layout/sidebar');
        $this->load->view('siswa/peminjamansiswa/detail_riwayat_peminjaman', $data);
        $this->load->view('siswa/layout/footer');
    }
}
