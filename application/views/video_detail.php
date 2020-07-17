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
        <h3>Video Detail : <?= $result->title ?></h3>
        <div class="row">
            <div class="col-sm-12">
                <p>Filename : <?= $result->original_filename ?></p>
                <p>MimeType : <?= $result->mimetype ?></p>
                <p>Encoding : <?= $result->encoding ?></p>
                <p>Status : <?= $result->status ?></p>
            </div>
        </div>
        <br>
        <h3>Video Thumbnail</h3>
        <?php foreach ($thumbs as $t): ?>
        <img class="img-fluid" src="<?= $this->scrapping->getAsset($t->file_url) ?>">
        <?php endforeach; ?>

        <h3>Video Files</h3>
        <?php foreach ($files as $f): ?>
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="<?= $this->scrapping->getAsset($f->file_url) ?>" allowfullscreen></iframe>
            </div>
        <?php endforeach; ?>
        <br>
    </div>
    <?php if($result->status != 'Published'): ?>
    <script>
        setTimeout(function () {
            location.reload();
        }, 2000)
    </script>
    <?php
    endif;
    ?>
</body>
</html>
