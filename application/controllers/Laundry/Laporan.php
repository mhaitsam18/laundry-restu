<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {
        $data['title'] = "Laporan";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('layouts/topbar', $data);
        $this->load->view('laporan/index', $data);
        $this->load->view('layouts/footer');
    }

    public function print()
    {
        $data['title'] = "Laporan";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->select('laundry.*, user.name, jenis_laundry.jenis_laundry, jenis_laundry.tipe_laundry');
        $this->db->join('member', 'laundry.member_id = member.id', 'left');
        $this->db->join('user', 'member.user_id = user.id', 'left');
        $this->db->join('jenis_laundry', 'laundry.jenis_laundry_id = jenis_laundry.id');
        $this->db->where('MONTH(laundry.created_at)', $this->input->post('bulan'));
        $this->db->where('YEAR(laundry.created_at)', $this->input->post('tahun'));
        $laundrys = $this->db->get('laundry')->result();

        $this->db->select('member_paket.*, user.name, paket.paket, paket.lama');
        $this->db->join('paket', 'member_paket.paket_id = paket.id');
        $this->db->join('member', 'member_paket.member_id = member.id', 'left');
        $this->db->join('user', 'member.user_id = user.id', 'left');
        $this->db->where('MONTH(member_paket.created_at)', $this->input->post('bulan'));
        $this->db->where('YEAR(member_paket.created_at)', $this->input->post('tahun'));
        $member_pakets = $this->db->get_where('member_paket')->result();

        $laporan = [];
        $index = 0;
        foreach ($laundrys as $laundry) {
            if ($laundry->harga > 0) {
                $laporan[$index]['tanggal'] = $laundry->created_at;
                $laporan[$index]['waktu_transaksi'] = cari_tanggal($laundry->created_at);
                $laporan[$index]['member'] = $laundry->name;
                if ($laundry->tipe_laundry == 'laundry berat') {
                    $satuan = 'kg';
                } elseif ($laundry->tipe_laundry == 'laundry tetap') {
                    $satuan = 'pcs';
                } else{
                    $satuan = '-';
                }
                $laporan[$index]['pembayaran'] = $laundry->jenis_laundry.' '.$laundry->berat.' '.$satuan;
                if ($laundry->harga !== null) {
                    $laporan[$index]['harga_rupiah'] = 'Rp.'.number_format($laundry->harga,2,',','.');
                    $laporan[$index]['harga'] = $laundry->harga;
                } else{
                    $laporan[$index]['harga_rupiah'] = 'Rp. -';
                    $laporan[$index]['harga'] = 0;
                }
                $index++;
            }
        }
        foreach ($member_pakets as $member_paket) {
            if ($member_paket->harga_bayar > 0) {
                $laporan[$index]['tanggal'] = $member_paket->created_at;
                $laporan[$index]['waktu_transaksi'] = cari_tanggal($member_paket->created_at);
                $laporan[$index]['member'] = $member_paket->name;
                $laporan[$index]['pembayaran'] = 'Paket '.$member_paket->paket.' '.$member_paket->lama;
                $laporan[$index]['harga_rupiah'] = 'Rp.'.number_format($member_paket->harga_bayar,2,',','.');
                $laporan[$index]['harga'] = $member_paket->harga_bayar;
                $index++;
            }
        }

        // Mengambil kolom 'tanggal' dari array $laporan untuk dijadikan acuan pengurutan
        foreach ($laporan as $key => $row) {
            $tanggal[$key] = $row['tanggal'];
        }

        // Mengurutkan array $laporan berdasarkan tanggal transaksi secara menaik (ASC)
        // Jika ingin mengurutkan secara menurun (DESC), gunakan SORT_DESC
        if($laporan){
            array_multisort($tanggal, SORT_ASC, $laporan);
        }
        $data['laporans'] = $laporan;
        $data['tahun'] = $this->input->post('tahun');
        $data['bulan'] = cari_bulan($this->input->post('bulan'));
        $this->load->view('laporan/print', $data);
    }
}
