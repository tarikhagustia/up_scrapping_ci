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
        <h3>Tiktok Trending</h3>
        <div class="row">
            <?php foreach ($results->collector as $i):?>
            <div class="col-sm-4">
                <div class="card">
                    <div class="embed-responsive embed-responsive-16by9">
                        <video width="320" height="240" controls>
                            <source src="<?= $i->videoUrlNoWaterMark ?>" type="video/mp4">
                        </video>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $i->authorMeta->name ?></h5>
                        <h5 class="card-title"><?= $i->text ?></h5>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</body>
</html>
