<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Riwayatkembali extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('madmin');
		$this->load->library('pagination');
	}

	//riwayat pengembalian
	public function index()
	{
		if (!$this->session->userdata('session_siswa') || empty($this->session->userdata('session_siswa')['id_siswa'])) {
            redirect('siswapanel');
        }

        $id_siswa = $this->session->userdata('session_siswa')['id_siswa'];
        $data['user'] = $this->db->get_where('tbl_siswa', ['id_siswa' => $id_siswa])->row_array();

		$config['total_rows'] = $this->madmin->countDatariwayatpeminjaman();
		$config['per_page'] = 10;
		$config['uri_segment'] = 3; // Sesuaikan dengan segmen URI yang digunakan untuk nomor halaman
		$config['use_page_numbers'] = TRUE;

		$this->pagination->initialize($config);


		$page = $this->uri->segment(3) ? $this->uri->segment(3) : 1;

		$offset = ($page - 1) * $config['per_page'];

		$data['riwayat'] = $this->madmin->get_all_riwayatpengembalian($config['per_page'], $offset);
		$data['total_pages'] = ceil($config['total_rows'] / $config['per_page']);

		$data['current_page'] = $page;
		$data['pagination'] = $this->pagination->create_links();

		$data['title'] = 'Riwayat pengembalian';
		$this->load->view('Admin/layout/header', $data);
		$this->load->view('Admin/layout/sidebar');
		$this->load->view('Admin/riwayat_pengembalian/daftar_pengembalian', $data);
		$this->load->view('Admin/layout/footer');
	}

	//pengurutan 
	public function pengurutanData()
	{
		if (!$this->session->userdata('session_siswa') || empty($this->session->userdata('session_siswa')['id_siswa'])) {
            redirect('siswapanel');
        }

		$config['total_rows'] = $this->madmin->countDatariwayat();
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;

		$this->pagination->initialize($config);
		$page = $this->uri->segment(3) ? $this->uri->segment(3) : 1;

		$urutan = $this->input->post('urutan');

		$offset = ($page - 1) * $config['per_page'];
		$data['riwayat'] = $this->madmin->sortriwayatpengembalian($urutan, $config['per_page'], $offset);
		$data['total_pages'] = ceil($config['total_rows'] / $config['per_page']);


		$data['current_page'] = $page;
		$data['pagination'] = $this->pagination->create_links();

        $id_siswa = $this->session->userdata('session_siswa')['id_siswa'];
        $data['user'] = $this->db->get_where('tbl_siswa', ['id_siswa' => $id_siswa])->row_array();


		$data['title'] = 'Riwayat Peminjaman';
		$this->load->view('Admin/layout/header', $data);
		$this->load->view('Admin/layout/sidebar');
		$this->load->view('Admin/riwayat_pengembalian/pengurutan_data', $data);
		$this->load->view('Admin/layout/footer');
	}

	//cari nama
	public function cariData()
	{
		if (!$this->session->userdata('session_siswa') || empty($this->session->userdata('session_siswa')['id_siswa'])) {
            redirect('siswapanel');
        }

        $id_siswa = $this->session->userdata('session_siswa')['id_siswa'];
        $data['user'] = $this->db->get_where('tbl_siswa', ['id_siswa' => $id_siswa])->row_array();


		$keyword = $this->input->get('keyword');
		$data['riwayat'] = $this->madmin->search_riwayat_by_nama($keyword);

		$data['title'] = 'Pencarian Riwayat';
		$this->load->view('Admin/layout/header', $data);
		$this->load->view('Admin/layout/sidebar');
		$this->load->view('Admin/riwayat_pengembalian/pencarian_riwayat', $data);
		$this->load->view('Admin/layout/footer');
	}
	public function detail_data($id)
	{
		if (!$this->session->userdata('session_siswa') || empty($this->session->userdata('session_siswa')['id_siswa'])) {
            redirect('siswapanel');
        }

        $id_siswa = $this->session->userdata('session_siswa')['id_siswa'];
        $data['user'] = $this->db->get_where('tbl_siswa', ['id_siswa' => $id_siswa])->row_array();

		$data['riwayat'] = $this->madmin->detail_pengembalian($id);

		$data['title'] = 'Detail Pengembalian';
		$this->load->view('Admin/layout/header', $data);
		$this->load->view('Admin/layout/sidebar');
		$this->load->view('Admin/riwayat_pengembalian/detail_pengembalian', $data);
		$this->load->view('Admin/layout/footer');
	}
	public function hapus_riwayat($id)
	{
		if (empty($this->session->userdata('username'))) {
			redirect('adminpanel');
		}

		$this->madmin->delete('tbl_pengambalian', 'id_pengembalian', $id);
		$this->session->set_flashdata('success', 'Data Pengembalian Berhasil dihapus.');
		redirect('riwayatkembali', 'refresh');
	}
}
