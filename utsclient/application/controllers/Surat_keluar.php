<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_keluar extends CI_Controller
{

    public function index()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://localhost/utspengarsipan/api/Surat_keluar');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        $data['surat_keluar'] = json_decode($result, TRUE);
        curl_close($curl);

        $this->load->view('templates/header');
        $this->load->view('Surat_keluar', $data);
        $this->load->view('templates/footer');
    }
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
