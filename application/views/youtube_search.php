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
        <h3>Youtube Scrapping Search with query in <?= $this->input->get('q') ?></h3>
        <div class="row">
            <?php foreach ($results->items as $i):?>
            <div class="col-sm-4">
                <div class="card">
                    <img class="card-img-top" src="<?= $i->snippet->thumbnails->high->url ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?= $i->snippet->title ?></h5>
                        <p class="card-text"><?= $i->snippet->description ?></p>
                        <a href="https://www.youtube.com/watch?v=<?php $i->id->videoId ?>" class="btn btn-default"><?= $i->snippet->channelTitle ?></a>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</body>
</html>
