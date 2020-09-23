<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Favlist extends CI_Controller {

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
        parent::__construct();
    }

    public function index()
    {
		$count = $this->db->count_all_results('favlist');
		$count1 = 1;
        $this->load->view('favorite', compact('count', 'count1'));
    }

    public function save()
    {
	$this->load->model('favlist_model');
       $userku =1;
	$sql = "select favlist_id from favlist WHERE id_users='$userku'";
			$query = $this->db->query($sql);
			$record = $query->num_rows();
	if($record > 0){
		$sql = "update favlist SET content_id='' WHERE id_users='$userku'";
			$query = $this->db->query($sql);
       }else{
        $input = array('favlist_id'    		=> NULL,
							  'id_users'   			=> $userku,
                                                   'content_id'   			=> 'Y');
	            $this->favlist_model->insertfav_data($input);
      }
    }
}
