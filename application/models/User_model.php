<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('encrypt');
        $this->load->library('session');
        $this->load->database();
    }

    public function user($token)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('token', $token);
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
            return true;
        }
        else
        {
            return false;
        }
    }

    public function bounty_hunter($token)
    {
        $this->db->select('*');
        $this->db->from('bounty_hunter');
        $this->db->where('token', $token);
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
            return true;
        }
        else
        {
            return false;
        }
    }

    public function bounty_hunters()
    {
        $this->db->select('*');
        $this->db->from('bounty_hunter');
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
            return true;
        }
        else
        {
            return false;
        }
    }

    public function bountyhunters()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('access_level', 0);
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
            return true;
        }
        else
        {
            return false;
        }
    }

    public function bounty_profile($token)
    {
        $this->db->select('*');
        $this->db->from('bounty_profile');
        $this->db->where('token', $token);
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->result();
            return true;
        }
        else
        {
            return false;
        }
    }
}