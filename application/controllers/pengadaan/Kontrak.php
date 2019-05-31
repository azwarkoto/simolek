<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Kontrak extends CI_Controller
    {
      function __construct()
      {
        parent::__construct();
        $this->load->model('pengadaan/Kontrak_model');
        $this->load->library('form_validation');
      }


      // index for admin only
      public function index()
      {
        $kontrak = $this->Kontrak_model->get_all();

        $data = array(
          'kontrak_data' => $kontrak,
          'controller' => 'Kontrak',
          'uri1' => 'List Kontrak',
          'main_view' => 'pengadaan/kontrak/kontrak_list'
        );

        $this->load->view('template_view', $data);
      }

      public function read($id)
      {
        $row = $this->Kontrak_model->get_by_id($id);
        if ($row) {
          $data = array(
            'controller' => 'Kontrak',
            'uri1' => 'Data Kontrak',
            'main_view' => 'pengadaan/kontrak/kontrak_read',

            'id' => $row->id,
            'nomor' => $row->nomor,
            'tanggal' => $row->tanggal,
            'penyedia' => $row->penyedia,
            'lama' => $row->lama,
            'awal' => $row->awal,
            'akhir' => $row->akhir,
            'ket' => $row->ket,
          );
          $this->load->view('template_view', $data);
        } else {
          $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
          redirect(site_url('kontrak'));
        }
      }

      public function create($id_p)
      {
        $data = array(
          'button' => 'Simpan',
          'action' => site_url('pengadaan/kontrak/create_action'),
          'controller' => 'Kontrak',
          'uri1' => 'Tambah Kontrak',
          'main_view' => 'pengadaan/kontrak/kontrak_form',

          'id_p' => set_value('id_p',$id_p),
          'nomor' => set_value('nomor'),
          'tanggal' => set_value('tanggal'),
          'penyedia' => set_value('penyedia'),
          'lama' => set_value('lama'),
          'awal' => set_value('awal'),
          'akhir' => set_value('akhir'),
          'ket' => set_value('ket'),
          'id_k' => set_value('id_k'),
        );
        $this->load->view('template_view', $data);
      }

      public function create_action()
      {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
          $this->create();
        } else {
          $data = array(
            'pekerjaan' => $this->input->post('id_p',TRUE),
            'nomor' => $this->input->post('nomor',TRUE),
            'tanggal' => $this->input->post('tanggal',TRUE),
            'penyedia' => $this->input->post('penyedia',TRUE),
            'lama' => $this->input->post('lama',TRUE),
            'awal' => $this->input->post('awal',TRUE),
            'akhir' => $this->input->post('akhir',TRUE),
            'ket' => $this->input->post('ket',TRUE),
          );

          $this->Kontrak_model->insert($data);
          $this->session->set_flashdata('message', 'Data Berhasil Ditambahkan');
          redirect(site_url('pengadaan/pekerjaan/read/'.$this->input->post('id_p',TRUE)));
        }
      }

      public function update($id_k,$id_p)
      {
        $row = $this->Kontrak_model->get_by_id($id_k);

        if ($row) {
          $data = array(
            'button' => 'Update',
            'action' => site_url('pengadaan/kontrak/update_action'),
            'controller' => 'Kontrak',
            'uri1' => 'Update Kontrak',
            'main_view' => 'pengadaan/kontrak/kontrak_form',

            'id_k' => set_value('id_k', $row->id),
            'nomor' => set_value('nomor', $row->nomor),
            'tanggal' => set_value('tanggal', $row->tanggal),
            'penyedia' => set_value('penyedia', $row->penyedia),
            'lama' => set_value('lama', $row->lama),
            'awal' => set_value('awal', $row->awal),
            'akhir' => set_value('akhir', $row->akhir),
            'ket' => set_value('ket', $row->ket),
            'id_p' => set_value('id_p', $row->pekerjaan),
          );
          $this->load->view('template_view', $data);
        } else {
          $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
          redirect(site_url('pengadaan/pekerjaan'));
        }
      }

      public function update_action()
      {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
          $this->update($this->input->post('id_k', TRUE));
        } else {
          $data = array(
            'nomor' => $this->input->post('nomor',TRUE),
            'tanggal' => $this->input->post('tanggal',TRUE),
            'penyedia' => $this->input->post('penyedia',TRUE),
            'lama' => $this->input->post('lama',TRUE),
            'awal' => $this->input->post('awal',TRUE),
            'akhir' => $this->input->post('akhir',TRUE),
            'ket' => $this->input->post('ket',TRUE),
            'pekerjaan' => $this->input->post('id_p',TRUE),
          );

          $this->Kontrak_model->update($this->input->post('id_k', TRUE), $data);
          $this->session->set_flashdata('message', 'Update Data Berhasil');
          redirect(site_url('pengadaan/pekerjaan/read/'.$this->input->post('id_p',TRUE)));
        }
      }

      public function delete($id_k,$id_p)
      {
        $row = $this->Kontrak_model->get_by_id($id_k);

        if ($row) {
          $this->Kontrak_model->delete($id_k);
          $this->session->set_flashdata('message', 'Data Berhasil Dihapus');
          redirect(site_url('pengadaan/pekerjaan/read/'.$row->pekerjaan));
        } else {
          $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
          redirect(site_url('pengadaan/pekerjaan/read/'.$row->pekerjaan));
        }
      } 

      public function _rules()
      {
        $this->form_validation->set_rules('nomor', 'nomor', 'trim|required');
        $this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
        $this->form_validation->set_rules('penyedia', 'penyedia', 'trim|required');
        $this->form_validation->set_rules('lama', 'lama', 'trim|required');
        $this->form_validation->set_rules('awal', 'awal', 'trim|required');
        $this->form_validation->set_rules('akhir', 'akhir', 'trim|required');
        $this->form_validation->set_rules('ket', 'ket', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
      }

      function pdf()
      {
        $data = array(
          'kontrak_data' => $this->Kontrak_model->get_all(),
          'start' => 0
        );

        ini_set('memory_limit', '32M');
        $this->load->library('pdfgenerator');
        $psize = 'folio'; //setting kertas
        $orient = 'landscape'; 	//setting orientasi

        $html = $this->load->view('pengadaan/kontrak/kontrak_pdf', $data, true);

        $this->pdfgenerator->generate($html,'list Kontrak',$psize,$orient);

      }

    }

/* End of file Kontrak.php */
/* Location: ./application/controllers/Kontrak.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-05-27 14:32:28 */
/* http://harviacode.com */
?>
