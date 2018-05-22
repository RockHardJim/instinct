<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('encrypt');
        $this->load->library('session');
        $this->load->database();
    }

    public function register_vehicle($vehicle_code, $level, $name, $license_plate)
    {

    }

    public function lookup_vehicle($token)
    {
        $this->ci->db->select('*');
        $this->ci->db->from('vehicles');
        $this->ci->db->where('token', $token);
        $query = $this->ci->db->get();

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

    public function deliveries($token)
    {
        $this->db->select('*');
        $this->ci->db->from('deliveries');
        $this->ci->db->where('token', $token);
        $query = $this->ci->db->get();

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

    public function deliveries_profile_location($token)
    {
        $this->db->select('*');
        $this->ci->db->from('delivery_profile_location');
        $this->ci->db->where('token', $token);
        $query = $this->ci->db->get();

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

    public function delivery()
    {
        $this->db->select('*');
        $this->db->from('deliveries');
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

    public function vehicles()
    {
        $this->db->select('*');
        $this->db->from('vehicles');
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