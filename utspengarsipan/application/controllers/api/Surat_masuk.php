<?php

defined('BASEPATH') or exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;


class Surat_masuk extends REST_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        //batasan yang kita tentukan 
        $this->methods['index_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['index_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['index_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->methods['index_put']['limit'] = 50; // 50 requests per hour per user/key
    }
    //method index untuk menampilkan semua data person menggunakan method get
    public function index_get()
    {
        // Users from a data store e.g. database
        $kode_surat = $this->get('kode_surat');

        // If the id parameter doesn't exist return all the users

        if ($kode_surat === NULL) {
            //menggabungkan beberapa tabel
            $this->db->select('*');
            $this->db->from('surat_masuk sm');
            $this->db->join('instansi i', 'i.nomor_instansi = sm.nomor_instansi');
            $surat_masuk = $this->db->get()->result_array();
            // Periksa apakah penyimpanan data pengguna berisi pengguna (jika hasil database mengembalikan NULL)
            if ($surat_masuk) {
                // Set the response and exit
                $this->response($surat_masuk, REST_Controller::HTTP_OK); // digunakan untuk mengecek apakah kode
                //itu berfungsi atau gagal jika ID yang diberikan tidak ada dalam database maka data tidak di temukan
            } else {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'Tidak Ditemukan Transaksi'
                ], REST_Controller::HTTP_NOT_FOUND); // terjadi kesalahan HTTP
            }
        }

        // Find and return a single record for a particular user.
        else {
            $kode_surat = (int) $kode_surat;

            // Validate the id.
            if ($kode_surat <= 0) {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); //terjadi kesalahan pada HTTP
            }
            //menggabungkan beberapa tabel
            $this->db->query("select * from surat_masuk sm join instansi i on i.nomor_instansi = sm.nomor_instansi DESC");
            $surat_masuk = $this->db->get("surat_masuk")->row_array();

            $this->response($surat_masuk, REST_Controller::HTTP_OK);
        }
    }
    // Metode POST digunakan untuk mengirimkan data baru dari client ke server REST API
    public function index_post()
    {
        // $this->some_model->update_user( ... );
        $data = [
            'nomor_instansi' => $this->post('nomor_instansi'),
            'no_agenda' => $this->post('no_agenda'),
            'isi_ringkasan' => $this->post('isi_ringkasan'),
            'no_surat' => $this->post('no_surat'),
            'tgl_surat' => $this->post('tgl_surat'),
            'tgl_diterima' => $this->post('tgl_diterima'),
            'penerima' => $this->post('penerima'),

        ];

        $this->db->insert("surat_masuk", $data);

        $this->set_response($data, REST_Controller::HTTP_CREATED); //terjadi kesalahan pada HTTP
    }
    // Metode DELETE digunakan untuk menghapus data yang telah ada di server REST API.
    public function index_delete()
    {
        // $this->some_model->delete_something($id);

        $kode_surat = $this->delete('kode_surat');
        $this->db->where('kode_surat', $kode_surat);
        $this->db->delete('surat_masuk');
        $messages = array('status' => "Data berhasil dihapus");
        $this->set_response($messages, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }
    // Metode PUT digunakan untuk memperbarui data yang telah ada di server REST API
    public function index_put()
    {
        $data = array(
            'no_agenda' => $this->put('no_agenda'),
            'isi_ringkasan' => $this->put('isi_ringkasan'),
            'no_surat' => $this->put('no_surat'),
            'tgl_surat' => $this->put('tgl_surat'),
            'tgl_diterima' => $this->put('tgl_diterima'),
            'penerima' => $this->put('penerima'),
            'nomor_instansi' => $this->put('nomor_instansi')
        );

        $this->db->where('kode_surat', $this->put('kode_surat'));
        $this->db->update('surat_masuk', $data);

        $this->set_response($data, REST_Controller::HTTP_CREATED);
    }
}
