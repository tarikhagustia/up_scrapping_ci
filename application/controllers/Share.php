<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Share extends CI_Controller
{
    protected $commentHtml = "";

    public function __construct()
    {
        parent::__construct();// you have missed this line.
    }

    public function index()
    {
        $title = "Info Gempa Hari Ini, Gempa M 6,9 dan 6,8 Guncang Bengkulu Warga Berlarian Keluar Rumah";
        $image = "https://cdn2.tstatic.net/jateng/foto/bank/images/ilustrasi-gempa-bumi_20180519_220213.jpg";
        $description = "Info gempa hari Ini, gempa bermagnitudo 6,9 dan 6,8 pada Rabu (19/8/2020), pukul 05.23 WIB menggemparkan ribuan warga Bengkulu.";

        $this->load->view('share', compact('title', 'image', 'description'));
    }

}
