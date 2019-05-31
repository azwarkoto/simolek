<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Klasifikasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Klasifikasi_model');
        $this->load->library('form_validation');
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}
    }

    public function index()
    {
        $klasifikasi = $this->Klasifikasi_model->get_all();

        $data = array(
            'klasifikasi_data' => $klasifikasi,
			'controller'       => 'Klasifikasi',
			'uri1'             => 'List Klasifikasi',
			'main_view'        => 'klasifikasi/klasifikasi_list'
        );

        $this->load->view('template_view', $data);
    }

    public function read($id) 
    {
        $row = $this->Klasifikasi_model->get_by_id($id);
        if ($row) {
            $data = array(
			'controller'       => 'Klasifikasi',
			'uri1'             => 'Data Klasifikasi',
			'main_view'        => 'klasifikasi/klasifikasi_read',
			
			'id_klasifikasi'   => $row->id_klasifikasi,
			'nama_klasifikasi' => $row->nama_klasifikasi,
	    );
            $this->load->view('template_view', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('klasifikasi'));
        }
    }

    public function create() 
    {
        $data = array(
            'button'           => 'Simpan',
            'action'           => site_url('klasifikasi/create_action'),
			'controller'       => 'Klasifikasi',
			'uri1'             => 'Tambah Klasifikasi',
			'main_view'        => 'klasifikasi/klasifikasi_form',
			
			'id_klasifikasi'   => set_value('id_klasifikasi'),
			'nama_klasifikasi' => set_value('nama_klasifikasi'),
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
			'nama_klasifikasi'     => $this->input->post('nama_klasifikasi',TRUE),
	    );

            $this->Klasifikasi_model->insert($data);
            $this->session->set_flashdata('message', 'Data Berhasil Ditambahkan');
            redirect(site_url('klasifikasi'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Klasifikasi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button'       => 'Update',
                'action'       => site_url('klasifikasi/update_action'),
				'controller'   => 'Klasifikasi',
				'uri1'         => 'Update Klasifikasi',
				'main_view'    => 'klasifikasi/klasifikasi_form',
			
			'id_klasifikasi'   => set_value('id_klasifikasi', $row->id_klasifikasi),
			'nama_klasifikasi' => set_value('nama_klasifikasi', $row->nama_klasifikasi),
	    );
            $this->load->view('template_view', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('klasifikasi'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_klasifikasi', TRUE));
        } else {
            $data = array(
			'nama_klasifikasi'     => $this->input->post('nama_klasifikasi',TRUE),
	    );

            $this->Klasifikasi_model->update($this->input->post('id_klasifikasi', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Data Berhasil');
            redirect(site_url('klasifikasi'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Klasifikasi_model->get_by_id($id);

        if ($row) {
            $this->Klasifikasi_model->delete($id);
            $this->session->set_flashdata('message', 'Data Berhasil Dihapus');
            redirect(site_url('klasifikasi'));
        } else {
            $this->session->set_flashdata('message', 'Data Tidak Ditemukan');
            redirect(site_url('klasifikasi'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_klasifikasi', 'nama klasifikasi', 'trim|required');

	$this->form_validation->set_rules('id_klasifikasi', 'id_klasifikasi', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    function pdf()
    {
        $data = array(
            'klasifikasi_data' => $this->Klasifikasi_model->get_all(),
            'start'            => 0
        );
        
        ini_set('memory_limit', '32M');
		$this->load->library('pdfgenerator');
		$psize = 'folio'; //setting kertas
		$orient = 'landscape'; 	//setting orientasi		
 
	    $html = $this->load->view('klasifikasi/klasifikasi_pdf', $data, true);
	    
	    $this->pdfgenerator->generate($html,'list Klasifikasi',$psize,$orient); 
		       
    }

}

/* End of file Klasifikasi.php */
/* Location: ./application/controllers/Klasifikasi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-08-14 21:22:07 */
/* http://harviacode.com */
?>
