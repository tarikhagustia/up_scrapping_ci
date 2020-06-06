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
        <h3>Tiktok Discovery</h3>
        <?php foreach ($results as $r): ?>
        <h3><?= $r->tag ?></h3>
        <div class="row">
            <?php foreach ($r->videos as $v): ?>
            <div class="col">
                <img src="<?= $v->cover ?>" class="img-fluid">
                <a href="/tiktok/video?url=<?= $v->url ?>">View / Download</a>
            </div>
            <?php endforeach; ?>

        </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
