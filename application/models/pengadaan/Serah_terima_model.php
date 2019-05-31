<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Serah_terima_model extends CI_Model
{

  public $table = 'serah_terima';
  public $id = 'id';
  public $order = 'DESC';
  private $db2;

  function __construct()
  {
    parent::__construct();
    $this->db2 = $this->load->database('db2',TRUE);
  }

  // get all
  function get_all()
  {
    $this->db2->order_by($this->id, $this->order);
    return $this->db2->get($this->table)->result();
  }

  // get data by id
  function get_by_id($id)
  {
    $this->db2->where($this->id, $id);
    return $this->db2->get($this->table)->row();
  }

  // get total rows
  function total_rows($q = NULL) {
    $this->db2->like('id', $q);
    $this->db2->or_like('nomor', $q);
    $this->db2->or_like('tanggal', $q);
    $this->db2->or_like('penyedia', $q);
    $this->db2->from($this->table);
    return $this->db2->count_all_results();
  }

  // get data with limit and search
  function get_limit_data($limit, $start = 0, $q = NULL) {
    $this->db2->order_by($this->id, $this->order);
    $this->db2->like('id', $q);
    $this->db2->or_like('nomor', $q);
    $this->db2->or_like('tanggal', $q);
    $this->db2->or_like('penyedia', $q);
    $this->db2->limit($limit, $start);
    return $this->db2->get($this->table)->result();
  }

  // insert data
  function insert($data)
  {
    $this->db2->insert($this->table, $data);
  }

  // update data
  function update($id, $data)
  {
    $this->db2->where($this->id, $id);
    $this->db2->update($this->table, $data);
  }

  // delete data
  function delete($id)
  {
    $this->db2->where($this->id, $id);
    $this->db2->delete($this->table);
  }

}

/* End of file Serah_terima_model.php */
/* Location: ./application/models/Serah_terima_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-05-27 13:31:01 */
/* http://harviacode.com */
