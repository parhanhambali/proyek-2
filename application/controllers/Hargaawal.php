<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hargaawal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Harga Awal";
        $data['hargaawal'] = $this->admin->getHargaawal();
        $this->template->load('templates/dashboard', 'harga_awal/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required|trim');
        $this->form_validation->set_rules('supplier_id', 'Supplier', 'required');
        $this->form_validation->set_rules('barang_id', 'Barang', 'required');
        $this->form_validation->set_rules('jumlah_harga_awal', 'Mata Uang Barang', 'required|trim|numeric|greater_than[0]');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Harga Awal";
            $data['supplier'] = $this->admin->get('supplier');
            $data['barang'] = $this->admin->get('barang');

            // Mendapatkan dan men-generate kode transaksi barang masuk
            $kode = 'T-BM-' . date('ymd');
            $kode_terakhir = $this->admin->getMax('harga_awal', 'id_harga_awal', $kode);
            $kode_tambah = substr($kode_terakhir, -5, 5);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 5, '0', STR_PAD_LEFT);
            $data['id_harga_awal'] = $kode . $number;

            $this->template->load('templates/dashboard', 'harga_awal/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('harga_awal', $input);

            if ($insert) {
                set_pesan('data berhasil disimpan.');
                redirect('hargaawal');
            } else {
                set_pesan('Opps ada kesalahan!');
                redirect('hargaawal/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('harga_awal', 'id_harga_awal', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('hargaawal');
    }
}
