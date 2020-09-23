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

        if ($locale = $this->input->get('locale')) {
            $results = $this->scrapping->youtube($locale);
        }else{
            $results = $this->scrapping->youtube("ID");
        }
        $this->load->view('youtube', compact('results'));
    }

    public function search()
    {
        $q = $this->input->get('q');
        $results = $this->scrapping->youtubeSearch($q);
        $this->load->view('youtube_search', compact('results'));
    }

    public function search_location()
    {
        $q = $this->input->get('q');
echo '<br><br><br><br><br><br><br>';
        echo $location = '';//'-6.2293867,106.6894293';//$this->input->get('location');
        $radius = '';//$this->input->get('radius');
        $results = $this->scrapping->youtubeSearchLocation($q, $location, $radius);
        $this->load->view('youtube_search', compact('results'));
    }
}
