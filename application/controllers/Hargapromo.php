<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hargapromo extends CI_Controller
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
        $data['title'] = "Harga promo";
        $data['hargapromo'] = $this->admin->getHargapromo();
        $this->template->load('templates/dashboard', 'harga_promo/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('tanggal_keluar', 'Tanggal Keluar', 'required|trim');
        $this->form_validation->set_rules('barang_id', 'Barang', 'required');

        $input = $this->input->post('barang_id', true);
        $harga = $this->admin->get('barang', ['id_barang' => $input])['harga'];
        $harga_valid = $harga + 1;

        $this->form_validation->set_rules(
            'jumlah_harga_promo',
            'Jumlah Harga Promo',
            "required|trim|numeric|greater_than[0]|less_than[{$harga_valid}]",
            [
                'less_than' => "Jumlah Keluar tidak boleh lebih dari {$harga}"
            ]
        );
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Harga Promo";
            $data['barang'] = $this->admin->get('barang', null, ['harga >' => 0]);

            // Mendapatkan dan men-generate kode transaksi barang keluar
            $kode = 'T-BK-' . date('ymd');
            $kode_terakhir = $this->admin->getMax('harga_promo', 'id_harga_promo', $kode);
            $kode_tambah = substr($kode_terakhir, -5, 5);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 5, '0', STR_PAD_LEFT);
            $data['id_harga_promo'] = $kode . $number;

            $this->template->load('templates/dashboard', 'harga_promo/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('harga_promo', $input);

            if ($insert) {
                set_pesan('data berhasil disimpan.');
                redirect('hargapromo');
            } else {
                set_pesan('Opps ada kesalahan!');
                redirect('hargapromo/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('harga_promo', 'id_harga_promo', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('hargapromo');
    }
}
