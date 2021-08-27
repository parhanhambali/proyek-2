<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mata extends CI_Controller
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
        $data['title'] = "Mata";
        $data['mata'] = $this->admin->get('mata');
        $this->template->load('templates/dashboard', 'mata/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_mata', 'Nama Mata ', 'required|trim');
    }

    public function add()
    {
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Mata";
            $this->template->load('templates/dashboard', 'mata/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('mata', $input);
            if ($insert) {
                set_pesan('data berhasil disimpan');
                redirect('mata');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('mata/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Mata";
            $data['mata'] = $this->admin->get('mata', ['id_mata' => $id]);
            $this->template->load('templates/dashboard', 'mata/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('mata', 'id_mata', $id, $input);
            if ($update) {
                set_pesan('data berhasil disimpan');
                redirect('mata');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('mata/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('mata', 'id_mata', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('mata');
    }
}
