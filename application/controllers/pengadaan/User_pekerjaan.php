<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_pekerjaan extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('pengadaan/User_pekerjaan_model');
  }

  function list_user_pekerjaan()
  {
    $user_pekerjaan = $this->User_pekerjaan_model->get_user_pekerjaan();
    $data = array(
      'user_pekerjaan_data' => $user_pekerjaan,
      'controller' => 'Set User Pekerjaan',
      'uri1' => 'List Pekerjaan per User',
      'main_view' => 'pengadaan/pekerjaan/user_pekerjaan_list',
      'form_action' => site_url('pengadaan/user_pekerjaan/set_user'),
    );

    $this->load->view('template_view', $data);
  }

  function set_user(){
    $this->User_pekerjaan_model->update_user_pekerjaan();
    redirect(site_url('pengadaan/pekerjaan'));
  }

}
