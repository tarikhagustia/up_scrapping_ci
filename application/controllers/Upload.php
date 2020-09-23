<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

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
        $this->load->view('upload');
    }

    public function new()
    {
        $this->load->view('upload_form');
    }


    public function do_upload()
    {
        $title = $this->input->post('title');
$title = isset($title) ? $title : '';

        $config['upload_path']          = sys_get_temp_dir();
        $config['allowed_types']        = '*';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('video'))
        {
            $error = array('error' => $this->upload->display_errors());

            var_dump($error);
        }
        else
        {
            $data = $this->upload->data();
        }
        $response = $this->scrapping->uploadVideo($title, $data['full_path']);

        // Redirect to videos detail
        header("Content-Type: application/json");
        echo json_encode($response);
    }

    public function check_status($video_id)
    {
        $video = $this->db->get_where('videos', [
            "id" => $video_id
        ])->row();

        header("Content-Type: application/json");
        echo json_encode($video);
    }
}
