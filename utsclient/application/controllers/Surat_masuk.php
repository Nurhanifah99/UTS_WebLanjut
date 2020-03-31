<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_masuk extends CI_Controller
{

    public function index()
    {
        //untuk mengirim dan mengambil data melalui URL yang di tuju
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://localhost/utspengarsipan/api/Surat_masuk');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        $data['surat_masuk'] = json_decode($result, TRUE);
        curl_close($curl);

        $this->load->view('templates/header');
        $this->load->view('Surat_masuk', $data);
        $this->load->view('templates/footer');
    }
    //Tampilan HOme
    public function home()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/footer');
    }
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
