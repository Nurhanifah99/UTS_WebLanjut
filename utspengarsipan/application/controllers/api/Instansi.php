<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

//require APPPATH . '/libraries/Format.php';
use Restserver\Libraries\REST_Controller;
use Restserver\Libraries\Format;

class Instansi extends REST_Controller
{
    // construct
    function __construct()
    {
        parent::__construct();
        $this->load->model('Instansi_model', 'instansi');
    }
    //method index untuk menampilkan semua data person menggunakan method get
    function index_get()
    {
        $nomor_instansi = $this->get('nomor_instansi');
        if ($nomor_instansi === null) {
            $instansi = $this->instansi->getInstansi();
        } else {
            $instansi = $this->instansi->getInstansi($nomor_instansi);
        }

        if ($instansi) {
            $this->response([
                'status' => true,
                'data' => $instansi
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'nomor_instansi not found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    // Metode DELETE digunakan untuk menghapus data yang telah ada di server REST API.
    function index_delete()
    {
        $nomor_instansi = $this->delete('nomor_instansi');
        if ($nomor_instansi === null) {
            $this->response([
                'status' => false,
                'message' => 'provide an nomor_instansi'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->instansi->deleteInstansi($nomor_instansi) > 0) {
                $this->response([
                    'status' => true,
                    'nomor_instansi' => $nomor_instansi,
                    'message' => 'deleted'
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'nomor_instansi not found!'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    // Metode POST digunakan untuk mengirimkan data baru dari client ke server REST API
    public function index_post()
    {
        $data = [

            'nama_instansi' => $this->post('nama_instansi'),
            'alamat' => $this->post('alamat'),
        ];

        if ($this->instansi->createInstansi($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'new instansi has been created'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to create new data'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    // Metode PUT digunakan untuk memperbarui data yang telah ada di server REST API
    public function index_put()
    {
        $nomor_instansi = $this->put('nomor_instansi');
        $data = [
            'nomor_instansi' => $this->put('nomor_instansi'),
            'nama_instansi' => $this->put('nama_instansi'),
            'alamat' => $this->put('alamat'),

        ];
        if ($this->instansi->updateInstansi($data, $nomor_instansi) > 0) {
            $this->response([
                'status' => true,
                'message' => 'new instansi has been updated'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'failed to update data'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
