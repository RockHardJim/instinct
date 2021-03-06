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
        $data = array(
            'token' => md5($name.$vehicle_code.$level.$license_plate),
            'vehicle_code' => $vehicle_code,
            'level' => $level,
            'name' => $name,
            'license_plate' => $license_plate
        );
        $this->db->insert('vehicles', $data);
    }

    public function lookup_vehicle($token)
    {
        $this->db->select('*');
        $this->db->from('vehicles');
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

    public function deliveries($token)
    {
        $this->db->select('*');
        $this->db->from('deliveries');
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


    public function vehicle_deliveries($token)
    {
        $this->db->select('*');
        $this->db->from('deliveries');
        $this->db->where('vehicle_token', $token);
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

    public function deliveries_profile_location($token)
    {
        $this->db->select('*');
        $this->db->from('delivery_profile_location');
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

    public function create_bounty($amount, $level)
    {
        $data = array(
            'token' => md5($level.$amount),
            'class' => $level,
            'amount' => $amount
        );
        $this->db->insert('bounty', $data);
    }

    public function getbounties()
    {
        $this->db->select('*');
        $this->db->from('bounty');
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

    public function create_delivery($level, $amount, $vehicle_token, $bounty_token, $destination_latitude, $destination_longitude)
    {
        $data = array(
            'token' => md5($level.$amount.$vehicle_token.$bounty_token),
            'level' => $level,
            'amount' => $amount,
            'vehicle_token' => $vehicle_token,
            'bounty_token' => $bounty_token,
            'destination_latitude' => $destination_latitude,
            'destination_longitude' => $destination_longitude
        );
        $this->db->insert('deliveries', $data);

        $delivery_location = array(
            'token' => $data['token']
        );
        $this->db->insert('delivery_profile_location', $delivery_location);
        return $data['token'];
    }

    public function delivery_security($token, $hunter_token, $latitude, $longitude)
    {
        $data = array(
            'token' => $token,
            'hunter_token' => $hunter_token,
            'latitude' => $latitude,
            'longitude' => $longitude
        );
        $this->db->insert('delivery_profile_security', $data);
    }
}