<?php
defined('BASEPATH') or exit('No direct script access allowed');

class suratmasuk_model extends CI_Model
{
    // //menambil data dari database
    public function getAllsurat_masuk()
    {
        //menggabungkan beberapa tabel
        $this->db->select('*');
        $this->db->from('surat_masuk sm');
        $this->db->join('instansi i', 'i.nomor_instansi = sm.nomor_instansi');
        return $this->db->get()->result_array();
        // return $this->db->get('surat_masuk')->result_array();
    }
    //menambahkan surat masuk
    public function tambahdatasrtmk()
    {
        $data = [
            "no_agenda" => $this->input->post('no_agenda', true),
            "isi_ringkasan" => $this->input->post('isi_ringkasan', true),
            "no_surat" => $this->input->post('no_surat', true),
            "tgl_surat" => $this->input->post('tgl_surat', true),
            "tgl_diterima" => $this->input->post('tgl_diterima', true),
            "penerima" => $this->input->post('penerima', true),
            "nomor_instansi" => $this->input->post('nomor_instansi', true)

        ];

        $this->db->insert('surat_masuk', $data);
    }
    //menghapus data
    public function hapusdatasrtmk($kode_surat)
    {
        //untuk menyeleksi dan memberikan kondisi where
        $this->db->where('kode_surat', $kode_surat);
        $this->db->delete('surat_masuk');
    }

    public function getsuratByID($kode_surat)
    {
        return $this->db->get_where('surat_masuk', ['kode_surat' => $kode_surat])->row();
    }
    //mengubah data surat
    public function ubahdatasrtmk()
    {

        $data = [
            "no_agenda" => $this->input->post('no_agenda', true),
            "isi_ringkasan" => $this->input->post('isi_ringkasan', true),
            "no_surat" => $this->input->post('no_surat', true),
            "tgl_surat" => $this->input->post('tgl_surat', true),
            "tgl_diterima" => $this->input->post('tgl_diterima', true),
            "penerima" => $this->input->post('penerima', true),
            "nomor_instansi" => $this->input->post('nomor_instansi', true)
        ];
        //untuk menyeleksi dan memberikan kondisi where
        $this->db->where('kode_surat', $this->input->post('kode_surat'));
        $this->db->update('surat_masuk', $data);
    }
    //mencari data surat
    public function cariDataSurat()
    {
        $keyword = $this->input->post('keyword');
        $this->db->like('kode_surat', $keyword);
        $this->db->or_like('no_agenda', $keyword);
        // Kita load file surat_masuk.php sambil mengirim data surat_masuk hasil query function search di suratmasuk_Model
        return $this->db->get('surat_masuk')->result_array();
    }
    //untuk menggenerate data json yang akan ditampilkan pada konsep datatables servers
    public function datatabels()
    {
        //Descending berdasarkan field nama
        $query = $this->db->order_by('kode_surat', 'DESC')->get('surat_masuk');
        return $query->result_array();
    }
}
