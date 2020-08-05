<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instagram extends CI_Controller {

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
        $code = $this->input->get('code');
        $json = $this->input->get('json');

        $media = $this->scrapping->instagramMedia($code);
        if ($json){
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode($media));
        }
        if ($media->__typename === "GraphVideo") {
            $this->load->view('instagram_media_video', compact('media'));
        }

        if ($media->__typename === "GraphImage") {
            $this->load->view('instagram_media_image', compact('media'));
        }

        if ($media->__typename === "GraphSidecar") {
            $this->load->view('instagram_media_slider', compact('media'));
        }
    }

    public function search()
    {
        $search = $this->input->get('q');
        $results = $this->scrapping->instagramSearch($search);
        $this->load->view('instagram', compact('results'));
    }

    public function feed()
    {
        $search = $this->input->get('q');
        $results = $this->scrapping->instagramFeed($search);
        $this->load->view('instagram_feed', compact('results'));
    }
}
