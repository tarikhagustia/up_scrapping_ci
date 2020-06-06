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
        <h3>Video By <?= $media->owner->full_name ?></h3>
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="<?= $media->video_url ?>" allowfullscreen></iframe>
        </div>
        <h5>Caption :</h5>
        <p><?= $media->edge_media_to_caption->edges[0]->node->text ?></p>

        <code>
            <?php var_dump($media); ?>
        </code>
    </div>
</body>
</html>
