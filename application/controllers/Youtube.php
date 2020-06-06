<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Youtube extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

    public function __construct()
    {
        parent::__construct();// you have missed this line.
        $this->load->library('scrapping');
    }

    public function index()
    {
        $results = [];

        if ($locale = $this->input->get('locale')) {
            $results = $this->scrapping->youtube($locale);
            // var_dump/($results);
        }
        $this->load->view('youtube', compact('results'));
    }
}
