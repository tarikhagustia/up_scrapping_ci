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
        <h3>Image By <?= $media->owner->full_name ?></h3>
        Images
        <?php foreach ($media->display_resources as $dr): ?>
        <p>Width : <?= $dr->config_width ?></p>
        <p>Heigh : <?= $dr->config_height ?></p>
        <img src="<?= $dr->src ?>" class="img-fluid">
        <?php endforeach; ?>
        <h5> Image Slider</h5>
        <?php foreach ($media->edge_sidecar_to_children->edges as $rs): ?>
            <?php foreach ($rs->node->display_resources as $dr): ?>
                <p>Width : <?= $dr->config_width ?></p>
                <p>Heigh : <?= $dr->config_height ?></p>
                <img src="<?= $dr->src ?>" class="img-fluid">
            <?php endforeach; ?>
        <?php endforeach; ?>
        <h5>Caption :</h5>
        <p><?= $media->edge_media_to_caption->edges[0]->node->text ?></p>

        <code>
            <?php var_dump($media); ?>
        </code>
    </div>
</body>
</html>
