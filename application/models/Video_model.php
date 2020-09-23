<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class video_model extends CI_Model{

    public function insert_data($input)
    {
       $this->db->insert('vidaggrlib_2020', $input);
    }
}
