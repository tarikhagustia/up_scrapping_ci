<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tiktok extends CI_Controller {

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

    public function trending()
    {
        $results = $this->scrapping->tiktokTrending();
        $this->load->view('tiktok_trending', compact('results'));
    }

    public function discovery()
    {
        $results = $this->scrapping->tiktokDiscovery();
        $this->load->view('tiktok_discovery', compact('results'));
    }

    public function video()
    {
        $url = $this->input->get('url');
        $video = $this->scrapping->tiktokVideo($url);
        $this->load->view('tiktok_video', compact('video'));

    }


}
