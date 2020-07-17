<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Videos extends CI_Controller {

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
        $vid = $this->input->get('vid');
        if ($vid) {
            $this->db->where('id', $vid);
            $result = $this->db->get('videos')->row();
            $this->db->where('video_id', $vid);
            $thumbs = $this->db->get('thumbs')->result();

            $this->db->where('video_id', $vid);
            $files = $this->db->get('video_files')->result();

            // $video =
            $this->load->view('video_detail', compact('result', 'thumbs', 'files'));
        }
    }
}
