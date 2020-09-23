<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class favlist_model extends CI_Model{

    public function insertfav_data($input)
    {
       $this->db->insert('favlist', $input);
    }
}
