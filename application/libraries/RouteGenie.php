<?php defined('BASEPATH') OR exit('No direct script access allowed');
use GuzzleHttp\Client;

/**
 * Created by PhpStorm.
 * User: tumel
 * Date: 5/20/2018
 * Time: 12:00 AM
 */

Class RouteGenie
{

    private $ci;


    function __construct()
    {
        $this->ci =& get_instance();

        $this->ci->load->library('ocvr');


    }

    public function plan_route()
    {

    }
}