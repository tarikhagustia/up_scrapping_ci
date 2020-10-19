<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DailyMotionController extends CI_Controller
{

    protected $api;

    public function __construct()
    {
        parent::__construct();// you have missed this line.
        $this->load->config('daily_motion');
        $this->api = new Dailymotion();
        $this->api->setGrantType(Dailymotion::GRANT_TYPE_PASSWORD, $this->config->item('daily_motion_api_key'), $this->config->item('daily_motion_api_secret'), [], [
            'username' => $this->config->item('daily_motion_api_username'),
            'password' => $this->config->item('daily_motion_api_password')
        ]);
    }

    public function index()
    {
        $page = $this->input->get('page') ?? 1;
        $perPage = $this->input->get('per_page') ?? 9;

        $results = $this->api->get('/me/videos', [
            'fields' => ['id', 'title', 'channel', 'owner', 'embed_url', 'embed_html', 'thumbnail_url', 'description', 'status'],
            'page'   => $page,
            'limit'  => $perPage,
            // 'owner'  => 'x2fj06o'
        ]);


        $this->load->view('daily_motion', compact('results', 'perPage', 'page'));
    }
}
