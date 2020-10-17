<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OneSignal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();// you have missed this line.
        $this->load->library('Broadcast');
    }

    public function index()
    {
        $this->load->view('onesignal');
    }

    public function send()
    {
        $text = $this->input->post('text');
        $response = $this->broadcast->notify($text);
        var_dump($response);
    }
}
