<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scrapping
{
    const BASE_URL = "http://localhost:3000";

    public function youtube($locale)
    {

        return $this->send('/youtube/trending', [
            'locale' => $locale,
            'result' => 10
        ]);
    }

    public function youtubeSearch($query)
    {

        return $this->send('/youtube/search', [
            'q' => $query
        ]);
    }

    public function youtubeSearchLocation($query, $location, $radius)
    {

        return $this->send('/youtube/search', [
            'q' => $query,
            'location' => $location,
            'radius' => $radius
        ]);
    }

    private function send($url, $query)
    {

        $curl = curl_init();
        $base = self::BASE_URL;
        $query = http_build_query($query);
        curl_setopt_array($curl, array(
            CURLOPT_URL            => "{$base}{$url}?{$query}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "GET",
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    public function instagramSearch($query)
    {

        return $this->send('/instagram/search', [
            'q' => $query
        ]);
    }

    public function instagramFeed($query)
    {

        return $this->send('/instagram/media/hashtag', [
            'hashtag' => $query
        ]);
    }

    public function tiktokTrending()
    {
        return $this->send('/tiktok/trending', []);
    }

    public function tiktokDiscovery()
    {
        return $this->send('/tiktok/discovery', []);
    }

    public function tiktokVideo($url)
    {
        // var_dump('/tiktok/videos/'.$url);
        return $this->send('/tiktok/videos'.$url, []);
    }

    public function instagramMedia($code)
    {
        return $this->send('/instagram/media/'.$code, []);
    }

    public function uploadVideo($title, $location) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL            => self::BASE_URL."/upload/videos",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_POSTFIELDS     => array('title' => $title, 'video' => new CURLFILE($location)),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }

    public function getAsset($file) {
        return self::BASE_URL.$file;
    }
}
