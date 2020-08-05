<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facebook extends CI_Controller {


    public function __construct()
    {
        parent::__construct();// you have missed this line.
        $this->load->library('scrapping');
    }

    public function index()
    {
        $url = $this->input->get('url');
        if ($url){
            $data = $this->scrapping->facebookDownload($url);
            var_dump($data);
        }
        $this->load->view('facebook_download');
    }
}
