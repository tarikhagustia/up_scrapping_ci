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
var_dump($_FILES);
        $response = $this->scrapping->uploadVideo($title, $data['full_path']);
var_dump($response);

        // Redirect to videos detail
        //redirect('videos?vid='.$response->data->videoId);

//untuk ukuran compress nya dan lokasi url nya boleh di kasih var agar bisa di ganti/setting?
//isi dibawah ini adalah full url + nama file nya, contoh  https://apa.id/tarikh_upload/uploads/videos/17-video-2mp4-1920x1080.mp4
$captiondefault = '';//img 240x144
$captionmedium = '';//img 480x360
$captionhigh = '';//img 1280x720
$captionultra = '';//img 1920x1080
$urldefault= '';//img 240x144
$urlmedium= '';//img 480x360
$urlhigh= '';//img 1280x720
$urlultra= '';//img 1920x1080

$this->load->model('video_model');
						$input = array('vidaggrlib_id'		=> NULL,
									  'vidaggrlib_title'		=> $title,
									  'vidaggrlib_captiondefault'		=> $captiondefault,
									  'vidaggrlib_captionmedium'		=> $captionmedium,
									  'vidaggrlib_captionhigh'		=> $captionhigh,
									  'vidaggrlib_captionultra'		=> $captionultra,
									  'vidaggrlib_urldefault'		=> $urldefault,
									  'vidaggrlib_urlmedium'		=> $urlmedium,
									  'vidaggrlib_urlhigh'		=> $urlhigh,
									  'vidaggrlib_urlultra'		=> $urlultra,
									  'vidaggrlib_status'		=> 'Active');
						$this->video_model->insert_data($input);

		redirect('https://dev.apa.id/tarikh_upload/upload');



    }
}
