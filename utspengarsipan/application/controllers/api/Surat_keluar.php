<?php

defined('BASEPATH') or exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;


class Surat_keluar extends REST_Controller
{

    function __construct()
    {
        // construct
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
        $no_surat = $this->get('no_surat');

        // If the id parameter doesn't exist return all the users

        if ($no_surat === NULL) {
            //menggabungkan beberapa tabel
            $this->db->select('*');
            $this->db->from('surat_keluar sm');
            $this->db->join('instansi i', 'i.nomor_instansi = sm.nomor_instansi');
            $surat_keluar = $this->db->get()->result_array();
            // Periksa apakah penyimpanan data pengguna berisi pengguna (jika hasil database mengembalikan NULL)
            if ($surat_keluar) {
                // Set the response and exit
                $this->response($surat_keluar, REST_Controller::HTTP_OK); // digunakan untuk mengecek apakah kode
                //itu berfungsi atau gagal jika ID yang diberikan tidak ada dalam database maka data tidak di temukan
            } else {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'Tidak Ditemukan Transaksi'
                ], REST_Controller::HTTP_NOT_FOUND); // terjadi kesalahan HTTP
            }
        } else {
            $no_surat = (int) $no_surat;

            // Validate the id.
            if ($no_surat <= 0) {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }
            //JOIN dalam SQL digunakan untuk menampilkan data pada table yang saling berhubungan atau berelasi
            $this->db->query("select * from surat_keluar sm join instansi i on i.nomor_instansi = sm.nomor_instansi DESC");
            $surat_keluar = $this->db->get("surat_keluar")->row_array();

            $this->response($surat_keluar, REST_Controller::HTTP_OK);
        }
    }
    // Metode POST digunakan untuk mengirimkan data baru dari client ke server REST API
    public function index_post()
    {
        // $this->some_model->update_user( ... );
        $data = [
            'no_surat' => $this->post('no_surat'),
            'tgl_surat' => $this->post('tgl_surat'),
            'isi_ringkasan' => $this->post('isi_ringkasan'),
            'nomor_instansi' => $this->post('nomor_instansi')

        ];

        $this->db->insert("surat_keluar", $data);

        $this->set_response($data, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }
    // Metode DELETE digunakan untuk menghapus data yang telah ada di server REST API.
    public function index_delete()
    {
        // $this->some_model->delete_something($id);

        $no_surat = $this->delete('no_surat');
        $this->db->where('no_surat', $no_surat);
        $this->db->delete('surat_keluar');
        $messages = array('status' => "Data berhasil dihapus");
        $this->set_response($messages, REST_Controller::HTTP_NO_CONTENT); // terjadi kesalahan
    }
    // Metode PUT digunakan untuk memperbarui data yang telah ada di server REST API
    public function index_put()
    {
        $data = array(

            'no_surat' => $this->put('no_surat'),
            'tgl_surat' => $this->put('tgl_surat'),
            'isi_ringkasan' => $this->put('isi_ringkasan'),
            'nomor_instansi' => $this->put('nomor_instansi'),
        );

        $this->db->where('no_surat', $this->put('no_surat'));
        $this->db->update('surat_keluar', $data);

        $this->set_response($data, REST_Controller::HTTP_CREATED); // data tidak dapat ditemukan
    }
}
