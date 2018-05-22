<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class BountyHunter
{
    private $ci;


    function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->database();
        $this->ci->load->library('encrypt');
        $this->ci->load->library('email');
        $this->ci->load->library('session');
        $this->ci->load->helper('url');

    }

    public function register($token, $level = 'A')
    {
        $data = array(
            'token' => $token,
            'level' => $level
        );
        $this->ci->db->insert('bounty_hunter', $data);
    }

    public function register_profile($token)
    {
        $data = array(
            'token' => $token
        );
        $this->ci->db->insert('bounty_profile', $data);
    }


    public function update_location($latitude, $longitude)
    {

    }

    public function lookup($token)
    {
        $this->ci->db->select('*');
        $this->ci->db->from('bounty_hunter');
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
}