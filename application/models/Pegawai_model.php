<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Pegawai_model extends CI_Model
{

  public $table = 'pegawai';
  public $id = 'nip';
  public $order = 'DESC';

  function __construct()
  {
    parent::__construct();
  }

  // get all
  function get_all()
  {
    $this->db->select('*');
    $this->db->from('pegawai p');
    if (!$this->ion_auth->in_group('admin')) {
      $this->db->where('p.id_skpd',$this->session->userdata('id_skpd'));
    }
    $this->db->join('skpd s', 'p.id_skpd=s.id_skpd', 'left');
    $this->db->order_by('p.nip','asc');
    return $this->db->get()->result();
  }

  // get data by id
  function get_by_id($id)
  {
    $group_has_access = array('admin','pengelola');
    $this->db->select('*');
    $this->db->from('pegawai p');
    if (!$this->ion_auth->in_group($group_has_access)) {
      $this->db->where('p.id_skpd',$this->session->userdata('id_skpd'));
    }
    $this->db->where('nip',$id);
    $this->db->join('skpd s', 'p.id_skpd=s.id_skpd', 'left');
    return $this->db->get()->row();
  }

  // get data fk by id
  function get_fk_by_id($id)
  {
    $fk = $this->db->where('nip', $id)->from('jabatan')->count_all_results();
    return $fk;
  }

  // get total rows
  function total_rows($q = NULL) {
    $this->db->like('nip', $q);
    $this->db->or_like('nama_lengkap', $q);
    $this->db->or_like('id_skpd', $q);
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }

  // get data with limit and search
  function get_limit_data($limit, $start = 0, $q = NULL) {
    $this->db->order_by($this->id, $this->order);
    $this->db->like('nip', $q);
    $this->db->or_like('nama_lengkap', $q);
    $this->db->or_like('id_skpd', $q);
    $this->db->limit($limit, $start);
    return $this->db->get($this->table)->result();
  }

  // insert data
  function insert($data)
  {
    $this->db->insert($this->table, $data);
  }

  // update data
  function update($id, $data)
  {
    $this->db->where($this->id, $id);
    $this->db->update($this->table, $data);
  }

  // delete data
  function delete($id)
  {
    $this->db->where($this->id, $id);
    $this->db->delete($this->table);
  }

  function get_pk_sama($id)
  {
    $this->db->where($this->id, $id);
    return $this->db->count_all_results($this->table);
  }

}

/* End of file Pegawai_model.php */
/* Location: ./application/models/Pegawai_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-07-14 20:08:03 */
/* http://harviacode.com */
