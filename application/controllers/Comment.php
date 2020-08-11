<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends CI_Controller
{
    protected $commentHtml = "";

    public function __construct()
    {
        parent::__construct();// you have missed this line.
    }

    public function index()
    {
        $this->db->select("*")->from("comment");
        $this->db->where("comment_parentid", 0);
        $this->db->order_by("comment_id", "desc");
        $comments = $this->db->get()->result();
        $this->renderComment($comments);
        $commentHtml = $this->commentHtml;
        $this->load->view('comment', compact('comments', 'commentHtml'));
    }

    public function renderComment($comments)
    {
        foreach ($comments as $comment) {
            $this->commentHtml .= "<div class=\"media m-2\">
                <img class=\"mr-3 img-fluid\" width=\"64\" src=\"https://randomuser.me/api/portraits/lego/2.jpg\"
                     alt=\"Generic placeholder image\">
                <div class=\"media-body\">
                    <h5 class=\"mt-0\">User Name here</h5>
                    {$comment->comment_content}
                    <br>
                    <a href=\"#\" class=\"reply-btn\" data-comment=\"{$comment->comment_id}\">Reply</a>
               ";
            // Query for child
            $this->db->select("*")->from("comment");
            $this->db->where("comment_parentid", $comment->comment_id);
            $this->db->order_by("comment_id", "desc");
            $children = $this->db->get()->result();
            $this->renderComment($children);
            $this->commentHtml .= " </div>
            </div>";
        }
    }

    public function do_comment()
    {
        $comment = $this->input->post('comment');
        $userId = 1; // User ID goes here
        $this->db->insert("comment", [
            "comment_content"  => $comment,
            "id_users"         => $userId,
            "comment_parentid" => ($this->input->post("parent_id")) ? $this->input->post("parent_id") : 0
        ]);

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode([
                "success" => true,
                "data"    => [
                    "id" => $this->db->insert_id()
                ]
            ]));
    }
}
