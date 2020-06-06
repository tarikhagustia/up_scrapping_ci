<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scrapping
{
    const BASE_URL = "http://localhost:3000";

    public function youtube($locale){

        return $this->send('/youtube/trending', [
            'locale' => $locale,
            'result' => 10
        ]);
    }

    public function instagramSearch($query){

        return $this->send('/instagram/search', [
            'q' => $query
        ]);
    }

    private function send($url, $query){

        $curl = curl_init();
        $base = self::BASE_URL;
        $query = http_build_query($query);
        curl_setopt_array($curl, array(
            CURLOPT_URL => "{$base}{$url}?{$query}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }
}
