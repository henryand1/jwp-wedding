<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pesanan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_pesanan()
    {
        $this->db->select('*');
        $this->db->from('tb_order tbo');
        $this->db->join('tb_users tbu', 'tbu.user_id = tbc.user_id');
        $this->db->order_by('tbo.updated_at', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function get_all_katalog_landing()
    {
        $this->db->select('*');
        $this->db->from('tb_order tbo');
        $this->db->join('tb_users tbu', 'tbu.user_id = tbc.user_id');

        $this->db->order_by('tbc.updated_at', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function get_katalog_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('tb_order tbo');
        $this->db->join('tb_users tbu', 'tbu.user_id = tbc.user_id');
        $this->db->where('tbo.order_id', $id);
        $query = $this->db->get();
        return $query;
    }

    public function insert($data)
    {
        return $this->db->insert('tb_order', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('order_id', $id);
        $query = $this->db->update('tb_order', $data);
        return $query;
    }

    public function delete_by_id($id)
    {
        $this->db->where('order_id', $id);
        return $this->db->delete('tb_order');
    }
}
