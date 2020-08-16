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

    public function json()
    {

        $sql = "select * from comment where content_id='$video_id' AND comment_process='Active' AND comment_status='Active' AND content_parent='0' order by comment_id asc";
        $query = $this->db->query($sql);
        $response = array();
        $posts = array();
        foreach ($query->result_array() as $index => $row) {
            $comment_id = $row['comment_id'];
            $id_users = $row['id_users'];
            $content_parent = $row['content_parent'];
            $comment_content = $row['comment_content'];
            $comment_process = $row['comment_process'];
            $comment_time = $this->timeelapse->timeAgo($row['comment_c_date']);

            //convert comment sender
            $sql2 = "select fullname,users_email from users WHERE id_users='$id_users'";
            $query2 = $this->db->query($sql2);
            $row2 = $query2->row_array();
            $comment_sender = isset($row2['fullname']) ? $row2['fullname'] : '';
            if ($comment_sender == '') {
                $comment_sender0 = explode("@", $row2['users_email']);
                $comment_sender = isset($comment_sender0[0]) ? $comment_sender0[0] : '';
            }

            $posts[$index] = array(
                "komentar_id"      => $comment_id,
                "komentar_sender"  => $comment_sender,
                "komentar_parent"  => $content_parent,
                "komentar_content" => $comment_content,
                "komentar_waktu"   => $comment_time,
                "komentar_status"  => $comment_process,
            );

            $sql1 = "select * from comment where content_id='$video_id' AND comment_process='Active' AND comment_status='Active' AND content_parent='$comment_id' order by comment_id asc";
            $query1 = $this->db->query($sql1);
            $no = 0;
            foreach ($query1->result_array() as $row1) {
                //for($i=1;$i<3;$i++){
                ++$no;
                $comment_id1 = $row1['comment_id'];
                $id_users1 = $row1['id_users'];
                $content_parent1 = $row1['content_parent'];
                $comment_content1 = $row1['comment_content'];
                $comment_process1 = $row1['comment_process'];
                $comment_time1 = $this->timeelapse->timeAgo($row1['comment_c_date']);

                //convert comment sender
                $sql3 = "select fullname,users_email from users WHERE id_users='$id_users1'";
                $query3 = $this->db->query($sql3);
                $row3 = $query3->row_array();
                $comment_sender1 = isset($row3['fullname']) ? $row3['fullname'] : '';
                if ($comment_sender1 == '') {
                    $comment_sender10 = explode("@", $row3['users_email']);
                    $comment_sender1 = isset($comment_sender10[0]) ? $comment_sender10[0] : '';
                }

                $posts[$index]["reply"] = array(
                    "komentar_id"      => $comment_id1,
                    "komentar_sender"  => $comment_sender1,
                    "komentar_parent"  => $content_parent1,
                    "komentar_content" => $comment_content1,
                    "komentar_waktu"   => $comment_time1,
                    "komentar_status"  => $comment_process1,
                );
            }
        }
        $response['komentar'] = $posts;
    }
}
