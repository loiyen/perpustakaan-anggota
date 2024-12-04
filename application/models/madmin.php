<?php
class madmin extends CI_Model
{
    public function check_login($u, $p)
    {
        $this->db->select('id_admin, username, password,Status');
        $this->db->from('tbl_admin');
        $this->db->where('username', $u);
        $query = $this->db->get();

        $user = $query->row_array();

        if ($user) {
            if (password_verify($p, $user['password'])) {
                if ($user['Status'] == '1') {
                    return $user;
                } else {
                    $this->session->set_flashdata('gagal', 'Akun tidak aktif. Harap hubungi administrator.');
                    redirect('adminpanel');
                }
            } else {
                $this->session->set_flashdata('gagal', 'Verifikasi kata sandi gagal.');
                redirect('adminpanel');
            }
        } else {
            $this->session->set_flashdata('gagal', 'Username tidak ditemukan.');
            redirect('adminpanel');
        }
    }


    public function hash_string($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    public function verify_string($input, $hash)
    {
        return password_verify($input, $hash);
    }


    //dataquery
    public function insert($tabel, $data)
    {
        $this->db->insert($tabel, $data);
    }

    public function get_by_id($tabel, $id)
    {
        return $this->db->get_where($tabel, $id);
    }
    public function update($tabel, $data, $pk, $id)
    {
        $this->db->where($pk, $id);
        $this->db->update($tabel, $data);
    }
    public function delete($tabel, $id, $val)
    {
        $this->db->delete($tabel, array($id => $val));
    }
    ///


    //tambah petugas 
    public function lev_petugas()
    {
        $this->db->select('*');
        $this->db->from('tbl_admin');
        $this->db->where('level', 0);

        $query = $this->db->get();
        return $query->result();
    }

    public function ubahStatusaktif_0($id, $status)
    {
        $data = array('Status' => $status);
        $this->db->where('id_admin', $id);
        $this->db->update('tbl_admin', $data);
    }
    public function ubahStatusaktif_1($id, $status)
    {
        $data = array('Status' => $status);
        $this->db->where('id_admin', $id);
        $this->db->update('tbl_admin', $data);
    }

    //kategori
    public function get_all_kategori()
    {
        $query = $this->db->get('tbl_kategori');
        return $query->result();
    }

    public function get_data_by_id($id)
    {
        $query = $this->db->get_where('tbl_kategori', array('id_kategori' => $id));
        return $query->row(); // Mengembalikan satu baris data
    }

    //siswa
    public function get_all_datasiswa($limit, $offset)
    {
        $this->db->limit($limit, $offset);
        $query = $this->db->get('tbl_siswa');
        return $query->result();
    }
    public function count_siswa()
    {
        return $this->db->count_all('tbl_siswa');
    }

    public function get_id_siswa($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_siswa');
        $this->db->where('tbl_siswa.id_siswa', $id);
        $query = $this->db->get();
        return $query->row();
    }

    //rak
    public function get_all_rak()
    {
        $query = $this->db->get('tbl_rak');
        return $query->result();
    }
    public function edit_rak($id)
    {
        $this->db->select('*');
        $this->db->from('tbl_rak');
        $this->db->where('tbl_rak.id_rak', $id);
        $query = $this->db->get();
        return $query->row();
    }


    //buku
    public function get_all_buku()
    {
        $query = $this->db->get('tbl_buku');
        return $query->result();
    }

    public function get_data_by_idbuku($id)
    {
        $query = $this->db->get_where('tbl_buku', array('id_buku' => $id));
        return $query->row(); // Mengembalikan satu baris data
    }
    public function get_buku_with_kategori($id)
    {
        $this->db->select('buku.*, kategori.nama_kategori');
        $this->db->from('tbl_buku as buku');
        $this->db->join('tbl_kategori as kategori', 'buku.id_kategori = kategori.id_kategori', 'left');
        $this->db->where('buku.id_buku', $id);
        $query = $this->db->get();
        return $query->row();
    }
    //peminjaman 
    public function get_all_siswa()
    {
        $this->db->select('*');
        $this->db->from('tbl_siswa');
        $this->db->order_by('tbl_siswa.nama_siswa', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    public function cariData($keyword)
    {
        $this->db->group_start();
        $this->db->like('kode_buku', $keyword);
        $this->db->or_like('judul_buku', $keyword);
        $this->db->group_end();
        $query = $this->db->get('tbl_buku');
        return $query->result();
    }


    //pagination peminjaman buku
    public function get_buku($limit, $start)
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get('tbl_buku');
        return $query->result();
    }

    public function count_buku()
    {
        return $this->db->count_all('tbl_buku');
    }
    //pengurutan
    public function getSortedData($urutan, $limit, $offset)
    {

        switch ($urutan) {
            case 'judul_asc':
                $this->db->order_by('judul_buku', 'ASC');
                break;
            case 'judul_desc':
                $this->db->order_by('judul_buku', 'DESC');
                break;
            case 'tanggal_asc':
                $this->db->order_by('date_created', 'ASC');
                break;
            case 'tanggal_desc':
                $this->db->order_by('date_created', 'DESC');
                break;
            default:
                // Default sorting criteria
                $this->db->order_by('judul_buku', 'ASC');
                break;
        }

        // Get paginated data from the database
        $query = $this->db->get('tbl_buku', $limit, $offset);
        return $query->result();
    }
    public function countAllData()
    {
        return $this->db->count_all('tbl_siswa');
    }

    public function cariDatasiswa($keyword)
    {
        $this->db->group_start();
        $this->db->like('nama_siswa', $keyword);
        $this->db->or_like('kelas_siswa', $keyword);
        $this->db->group_end();
        $query = $this->db->get('tbl_siswa');
        return $query->result();
    }
    public function get_all_denda()
    {
        $query = $this->db->get('tbl_denda');
        return $query->result();
    }

    //riwayat  + pagination 
    public function get_peminjaman_info($limit, $offset)
    {
        $this->db->select('tbl_peminjaman.*, tbl_siswa.nama_siswa, tbl_admin.nama_admin');
        $this->db->from('tbl_peminjaman');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_peminjaman.id_siswa');
        $this->db->join('tbl_admin', 'tbl_admin.id_admin = tbl_peminjaman.id_admin');
        $this->db->order_by('tbl_peminjaman.datecreated', 'DESC'); // Urutkan berdasarkan tanggal peminjaman secara descending (terbaru ke terlama)
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }


    public function countDatariwayat()
    {
        return $this->db->count_all('tbl_peminjaman');
    }

    public function get_detail_peminjaman($id)
    {

        $this->db->select('tbl_peminjaman.*,tbl_siswa.*');
        $this->db->from('tbl_peminjaman');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_peminjaman.id_siswa');
        $this->db->where('tbl_peminjaman.id_peminjaman', $id);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_detail_peminjamanitems($id)
    {

        $this->db->select('tbl_peminjamanitems.*,tbl_buku.*');
        $this->db->from('tbl_peminjamanitems');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjamanitems.id_buku');
        $this->db->join('tbl_peminjaman', 'tbl_peminjaman.id_peminjaman = tbl_peminjamanitems.id_peminjaman');
        $this->db->where('tbl_peminjamanitems.id_peminjaman', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function sortriwayat($urutan, $limit, $offset)
    {
        switch ($urutan) {
            case 'hari_ini':
                $this->db->where('DATE(tbl_peminjaman.datecreated)', date('Y-m-d'));
                break;
            case 'seminggu_lalu':
                $this->db->where('DATE(tbl_peminjaman.datecreated) >=', date('Y-m-d', strtotime('-1 week')));
                break;
            case 'sebulan_lalu':
                $this->db->where('DATE(tbl_peminjaman.datecreated) >=', date('Y-m-d', strtotime('-1 month')));
                break;
            default: // Default case
                // Tidak ada filter khusus, kembalikan semua riwayat
                break;
        }

        $this->db->select('tbl_peminjaman.*, tbl_siswa.nama_siswa, tbl_admin.nama_admin');
        $this->db->from('tbl_peminjaman');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_peminjaman.id_siswa');
        $this->db->join('tbl_admin', 'tbl_admin.id_admin = tbl_peminjaman.id_admin');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();

        return $query->result_array();
    }

    //pdf peminjaman 

    public function get_data($id)
    {
        $this->db->select('tbl_peminjamanitems.*,tbl_buku.*,tbl_peminjaman.*');
        $this->db->from('tbl_peminjamanitems');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjamanitems.id_buku');
        $this->db->join('tbl_peminjaman', 'tbl_peminjaman.id_peminjaman = tbl_peminjamanitems.id_peminjaman', 'left');
        $this->db->where('tbl_peminjamanitems.id_peminjaman', $id);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_data_peminjaman()
    {
        $this->db->select('tbl_peminjaman.*,tbl_siswa.*,tbl_admin.*');
        $this->db->from('tbl_peminjaman');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_peminjaman.id_siswa');
        $this->db->join('tbl_admin', 'tbl_admin.id_admin = tbl_peminjaman.id_admin');
        $query = $this->db->get();
        return $query->result();
    }



    //pencarian riwayat
    public function search_peminjaman_by_kode($keyword)
    {
        $this->db->select('tbl_peminjaman.*, tbl_siswa.nama_siswa, tbl_admin.nama_admin');
        $this->db->from('tbl_peminjaman');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_peminjaman.id_siswa');
        $this->db->join('tbl_admin', 'tbl_admin.id_admin = tbl_peminjaman.id_admin');
        $this->db->where('tbl_peminjaman.kode_peminjaman', $keyword);
        $query = $this->db->get();
        return $query->result();
    }
    //update status peminjaman 
    public function update_status_terlambat_otomatis()
    {
        // Ambil semua peminjaman yang belum kembali
        $this->db->where('status', 'Belum Kembali');
        $peminjaman = $this->db->get('tbl_peminjamanitems')->result();

        // Periksa setiap peminjaman
        foreach ($peminjaman as $p) {
            // Periksa apakah tanggal kembali sudah lewat
            if (strtotime($p->tanggal_kembali) < strtotime(date('Y-m-d'))) {
                // Jika tanggal kembali sudah lewat, ubah status menjadi "Terlambat"
                $this->db->where('id_peminjamanitems', $p->id_peminjamanitems); // Ubah menjadi id_peminjamanitems
                $this->db->update('tbl_peminjamanitems', array('status' => 'Terlambat'));
            }
        }
    }


    //PENGEMBALIAN
    public function get_all_pengembalian()
    {
        $query = $this->db->get('tbl_pengambalian');
        return $query->result();
    }

    public function search_buku_by_kode($keyword)
    {
        $this->db->select('tbl_peminjamanitems.*, tbl_buku.judul_buku, tbl_peminjaman.*');
        $this->db->from('tbl_peminjamanitems');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjamanitems.id_buku');
        $this->db->join('tbl_peminjaman', 'tbl_peminjaman.id_peminjaman = tbl_peminjamanitems.id_peminjaman');
        $this->db->where('tbl_peminjaman.kode_peminjaman', $keyword);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_pengembalian_by_id($item_id)
    {
        $this->db->select('tbl_peminjamanitems.*, tbl_buku.judul_buku, tbl_peminjaman.kode_peminjaman');
        $this->db->from('tbl_peminjamanitems');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjamanitems.id_buku');
        $this->db->join('tbl_peminjaman', 'tbl_peminjaman.id_peminjaman = tbl_peminjamanitems.id_peminjaman');
        $this->db->where('tbl_peminjamanitems.id_peminjamanitems', $item_id); // Mengubah kondisi where menjadi id_peminjamanitems
        $query = $this->db->get();
        return $query->row(); // Menggunakan row() karena kita hanya ingin satu hasil, bukan array dari hasil
    }
    //PAGINATION riwayat
    public function get_all_riwayatpengembalian($limit, $offset)
    {
        $this->db->select('tbl_pengambalian.*,tbl_buku.*,tbl_siswa.*, tbl_admin.*');
        $this->db->from('tbl_pengambalian');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_pengambalian.id_siswa');
        $this->db->join('tbl_admin', 'tbl_admin.id_admin = tbl_pengambalian.id_admin');
        $this->db->order_by('tbl_pengambalian.datecreated', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result();
    }

    public function countDatariwayatpeminjaman()
    {
        return $this->db->count_all('tbl_peminjaman');
    }

    public function sortriwayatpengembalian($urutan, $limit, $offset)
    {
        switch ($urutan) {
            case 'hari_ini':
                $this->db->where('DATE(tbl_pengambalian.datecreated)', date('Y-m-d'));
                break;
            case 'seminggu_lalu':
                $lastWeek = date('Y-m-d', strtotime('-1 week'));
                $this->db->where('DATE(tbl_pengambalian.datecreated) >=', $lastWeek);
                $this->db->where('DATE(tbl_pengambalian.datecreated) <=', date('Y-m-d'));
                break;
            case 'sebulan_lalu':
                $lastMonth = date('Y-m-d', strtotime('-1 month'));
                $this->db->where('DATE(tbl_pengambalian.datecreated) >=', $lastMonth);
                $this->db->where('DATE(tbl_pengambalian.datecreated) <=', date('Y-m-d'));
                break;
            default:
                // Default case: tidak perlu menambahkan kondisi WHERE
                break;
        }
        $this->db->select('tbl_pengambalian.*,tbl_buku.*, tbl_siswa.*, tbl_admin.*');
        $this->db->from('tbl_pengambalian');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_pengambalian.id_buku');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_pengambalian.id_siswa');
        $this->db->join('tbl_admin', 'tbl_admin.id_admin = tbl_pengambalian.id_admin');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result();
    }

    public function search_riwayat_by_nama($keyword)
    {
        $this->db->select('tbl_pengambalian.*,tbl_buku.*,tbl_siswa.*, tbl_admin.*');
        $this->db->from('tbl_pengambalian');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_pengambalian.id_buku');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_pengambalian.id_siswa');
        $this->db->join('tbl_admin', 'tbl_admin.id_admin = tbl_pengambalian.id_admin');
        $this->db->where('tbl_siswa.nama_siswa', $keyword);
        $query = $this->db->get();
        return $query->result();
    }

    //denda
    public function sortrdenda($urutan)
    {

        $this->db->select('tbl_pengambalian.*,tbl_buku.*,tbl_siswa.nama_siswa, tbl_admin.*');
        $this->db->from('tbl_pengambalian');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_pengambalian.id_buku');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_pengambalian.id_siswa');
        $this->db->join('tbl_admin', 'tbl_admin.id_admin = tbl_pengambalian.id_admin');
        $this->db->where('tbl_pengambalian.denda', $urutan);
        $query = $this->db->get();
        return $query->result();
    }

    public function countDatapengembalian()
    {
        return $this->db->count_all('tbl_pengambalian');
    }

    //dasboard
    public function hitung_jumlah_peminjaman()
    {
        return $this->db->count_all('tbl_peminjaman');
    }
    public function hitung_jumlahbuku()
    {
        return $this->db->count_all('tbl_buku');
    }
    public function hitung_jumlahsiswa()
    {
        return $this->db->count_all('tbl_siswa');
    }
    public function hitung_jumlahpinjam()
    {
        return $this->db->count_all('tbl_peminjamanitems');
    }
    public function hitung_jumlahpengembalian()
    {
        return $this->db->count_all('tbl_pengambalian');
    }
    public function hitung_pembayaran()
    {
        $this->db->select_sum('jumlah');
        $query = $this->db->get('tbl_pembayaran');
        return $query->row()->jumlah;
    }

    public function hapus_semua_data($nama_tabel)
    {
        $this->db->truncate($nama_tabel);
    }



    public function get_peminjamanitems($limit, $offset)
    {

        $this->db->select('tbl_peminjamanitems.*,tbl_buku.*,tbl_peminjaman.*');
        $this->db->from('tbl_peminjamanitems');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjamanitems.id_buku');
        $this->db->join('tbl_peminjaman', 'tbl_peminjaman.id_peminjaman = tbl_peminjamanitems.id_peminjaman');
        $this->db->order_by('tbl_peminjamanitems.tanggal_pinjam', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result();
    }

    public function countpeminjaman()
    {
        return $this->db->count_all('tbl_peminjamanitems');
    }

    //sort tanggal dasboard 
    public function get_sorted_data($start_date, $end_date)
    {
        $this->db->select('tbl_peminjamanitems.*,tbl_buku.*,tbl_peminjaman.*');
        $this->db->from('tbl_peminjamanitems');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjamanitems.id_buku');
        $this->db->join('tbl_peminjaman', 'tbl_peminjaman.id_peminjaman = tbl_peminjamanitems.id_peminjaman');
        $this->db->where('tanggal_pinjam >=', $start_date);
        $this->db->where('tanggal_pinjam <=', $end_date);
        $this->db->order_by('tanggal_pinjam', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }
    //print laporan peminjamanitems
    public function print_peminjamanitems()
    {
        $this->db->select('tbl_peminjamanitems.*,tbl_buku.*,tbl_peminjaman.*');
        $this->db->from('tbl_peminjamanitems');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_peminjamanitems.id_buku');
        $this->db->join('tbl_peminjaman', 'tbl_peminjaman.id_peminjaman = tbl_peminjamanitems.id_peminjaman');
        $this->db->order_by('tbl_peminjamanitems.tanggal_pinjam', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    //denda pembayaran 
    public function get_allsiswa()
    {
        $this->db->order_by('nama_siswa', 'ASC');
        $query = $this->db->get('tbl_siswa');
        return $query->result();
    }
    public function get_allbuku()
    {
        $this->db->order_by('judul_buku', 'ASC');
        $query = $this->db->get('tbl_buku');
        return $query->result();
    }
    public function get_allpembayaran()
    {
        $this->db->select('tbl_pembayaran.*,tbl_buku.*,tbl_siswa.*');
        $this->db->from('tbl_pembayaran');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_pembayaran.id_buku');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_pembayaran.id_siswa');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_allpembayaran_pag($limit, $offset)
    {
        $this->db->select('tbl_pembayaran.*,tbl_buku.*,tbl_siswa.*');
        $this->db->from('tbl_pembayaran');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_pembayaran.id_buku');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_pembayaran.id_siswa');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result();
    }
    public function countdenda()
    {
        return $this->db->count_all('tbl_pembayaran');
    }
    //laporan admin
    public function get_admin()
    {
        $query = $this->db->get('tbl_admin');
        return $query->result();
    }

    public function laporan_admin_peminjaman($id, $a, $w)
    {

        $this->db->select('tbl_peminjaman.*, tbl_siswa.nama_siswa, tbl_admin.nama_admin');
        $this->db->from('tbl_peminjaman');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_peminjaman.id_siswa');
        $this->db->join('tbl_admin', 'tbl_admin.id_admin = tbl_peminjaman.id_admin');
        $this->db->where('tbl_peminjaman.id_admin', $id);
        $this->db->where('tbl_peminjaman.datecreated >=', $a);
        $this->db->where('tbl_peminjaman.datecreated <=', $w);
        $this->db->order_by('tbl_peminjaman.datecreated', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function laporan_admin_pengembalian($id, $a, $w)
    {
        $this->db->select('tbl_pengambalian.*,tbl_buku.*,tbl_siswa.*, tbl_admin.*');
        $this->db->from('tbl_pengambalian');
        $this->db->join('tbl_buku', 'tbl_buku.id_buku = tbl_pengambalian.id_buku');
        $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = tbl_pengambalian.id_siswa');
        $this->db->join('tbl_admin', 'tbl_admin.id_admin = tbl_pengambalian.id_admin');
        $this->db->where('tbl_pengambalian.id_admin', $id);
        $this->db->where('tbl_pengambalian.datecreated >=', $a);
        $this->db->where('tbl_pengambalian.datecreated <=', $w);
        $this->db->order_by('tbl_pengambalian.datecreated', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function hitung_jumlah_peminjamanlaporan($id, $a, $w)
    {
        $this->db->where('tbl_peminjaman.id_admin', $id);
        $this->db->where('tbl_peminjaman.datecreated >=', $a);
        $this->db->where('tbl_peminjaman.datecreated <=', $w);
        return $this->db->count_all_results('tbl_peminjaman');
    }
    public function hitung_jumlah_pengembalianlaporan($id, $a, $w)
    {
        $this->db->where('tbl_pengambalian.id_admin', $id);
        $this->db->where('tbl_pengambalian.datecreated >=', $a);
        $this->db->where('tbl_pengambalian.datecreated <=', $w);
        return $this->db->count_all_results('tbl_pengambalian');
    }
    public function hitung_jumlahbukulaporan($a, $w)
    {

        $this->db->where('tbl_buku.date_created >=', $a);
        $this->db->where('tbl_buku.date_created <=', $w);
        return $this->db->count_all_results('tbl_buku');
    }
    public function hitung_jumlahsiswalaporan($a, $w)
    {

        $this->db->where('tbl_siswa.datecreated >=', $a);
        $this->db->where('tbl_siswa.datecreated <=', $w);
        return $this->db->count_all_results('tbl_siswa');
    }
    public function hitung_jumlahpembayaranlaporan($a, $w)
    {

        $this->db->where('tbl_pembayaran.datecreated >=', $a);
        $this->db->where('tbl_pembayaran.datecreated <=', $w);
        return $this->db->count_all_results('tbl_pembayaran');
    }
    public function hitung_laporanpembayaran($a, $w)
    {
        $this->db->select_sum('jumlah');
        $this->db->where('tbl_pembayaran.datecreated >=', $a);
        $this->db->where('tbl_pembayaran.datecreated <=', $w);
        $query = $this->db->get('tbl_pembayaran');
        return $query->row()->jumlah;
    }
}
