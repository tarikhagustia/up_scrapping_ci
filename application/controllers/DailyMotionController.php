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
        $perPage = $this->input->get('per_page') ?? 100;//9;

        $results = $this->api->get('/me/videos', [
            'fields' => ['id', 'title', 'channel', 'owner', 'embed_url', 'embed_html', 'thumbnail_url', 'description', 'status', 'thumbnail_120_url', 'thumbnail_180_url', 'thumbnail_240_url', 'thumbnail_360_url', 'thumbnail_480_url', 'thumbnail_720_url', 'thumbnail_1080_url'],
            'page'   => $page,
            'limit'  => $perPage,
            // 'owner'  => 'x2fj06o'
        ]);


        $this->load->view('daily_motion', compact('results', 'perPage', 'page'));
    }

    public function playlist()
    {
        $page = $this->input->get('page') ?? 1;
        $perPage = $this->input->get('per_page') ?? 100;//9;

        $results = $this->api->get('/me/playlists', [
            'fields' => ['id', 'name', 'videos_total', 'description', 'thumbnail_url'],
            'page'   => $page,
            'limit'  => $perPage,
            // 'owner'  => 'x2fj06o'
        ]);

        foreach ($results['list'] as $key => $item) {
            // Ambil video
            $videos = $this->api->get("/playlist/{$item['id']}/videos", [
                'fields' => ['id', 'title', 'channel', 'owner', 'embed_url', 'embed_html', 'thumbnail_url', 'description', 'status', 'thumbnail_120_url', 'thumbnail_180_url', 'thumbnail_240_url', 'thumbnail_360_url', 'thumbnail_480_url', 'thumbnail_720_url', 'thumbnail_1080_url'],
            ]);

            $results['list'][$key]['videos'] = $videos['list'];
        }


        $this->load->view('daily_motion_playlist', compact('results', 'perPage', 'page'));
    }
}
