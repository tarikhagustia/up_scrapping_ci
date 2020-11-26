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

    public function view_playlist($code)
    {
        $page = $this->input->get('page') ?? 1;
        $perPage = $this->input->get('per_page') ?? 100;//9;

        $results = $this->api->get("/playlist/$code/videos", [
            'fields' => ['id', 'title', 'channel', 'owner', 'embed_url', 'embed_html', 'thumbnail_url', 'description', 'status', 'thumbnail_120_url', 'thumbnail_180_url', 'thumbnail_240_url', 'thumbnail_360_url', 'thumbnail_480_url', 'thumbnail_720_url', 'thumbnail_1080_url'],
        ]);

        $this->load->view('daily_motion_playlist_video', compact('results', 'perPage', 'page', 'code'));
    }

    public function streaming()
    {

        $this->load->view('daily_motion_streaming');
    }

    public function start_live()
    {
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $startTime = strtotime($this->input->post('startTime'));
        $endTime = strtotime($this->input->post('endTime'));

        // Create video
        $videoResult = $this->api->post("/videos", [
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'mode' => 'live',
            'published' => true,
            'start_time' => $startTime,
            'end_time' => $endTime
        ]);
        // // Get Stream Url
        $result = $this->api->get("/video/" . $videoResult['id'], [
            'fields' => ['live_publish_url']
        ]);

        // Get Stream Part
        $urlParts = explode("/", $result['live_publish_url']);


        // This is detail
        $streamKeyPart = $urlParts[4];
        $streamUrlPart = "rtmp://publish.dailymotion.com/publish-dm";
        $fullUrl = $result['live_publish_url'];
        echo "</br>";
        echo "STREAM KEY PART : ".$streamKeyPart.PHP_EOL."</br>";
        echo "STREAM URL PART : ".$streamUrlPart.PHP_EOL."</br>";
        echo "STREAM FULL URL : ".$fullUrl.PHP_EOL."</br>";

    }
}
