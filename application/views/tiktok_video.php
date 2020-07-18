<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<body>
    <div class="container">
        <h3>Tiktok Video</h3>
        <video width="<?= $video->videoMeta->width ?>" height="<?= $video->videoMeta->height ?>" controls>
            <source src="<?= $video->videoUrl ?>" type="video/mp4">
        </video>
        <p>
            <?= $video->authorMeta->name ?>

        </p>
        <p>
            <?= $video->text ?>
        </p>
    </div>
</body>
</html>
