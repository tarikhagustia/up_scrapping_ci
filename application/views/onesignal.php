<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome to CodeIgniter</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<body>
<div class="container">
    <h1>Onesignal</h1>
    <form method="post" action="<?= base_url('onesignal/send') ?>">
        <input class="form-control" placeholder="Pesan disini" name="text">
        <br>
        <button class="btn btn-primary">Kirim Notifikasi</button>
    </form>
</div>
</body>
</html>
