<?php


class Broadcast
{
    protected $instance;

    public function __construct()
    {
        $this->instance = &get_instance();
        $this->instance->load->config('onesignal');
    }

    public function notify($text)
    {

        $appID = $this->instance->config->item('onesignal_app_id');
        $apiKey = $this->instance->config->item('onesignal_api_key');

        $content = array(
            "en" => $text
        );
        $fields = array(
            'app_id'            => $appID,
            'included_segments' => array(
                'All'
            ),
            'data'              => array(
                "foo" => "bar"
            ),
            'contents'          => $content,
        );

        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic '.$apiKey
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}
