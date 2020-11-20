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
        <h3>Daily Motion</h3>
        <p>Total Video : <?= $results['total'] ?></p>
        <p>Halaman : <?= $page ?></p>
        <p>Per Halaman : <?= $perPage ?></p>
        <div class="row">
            <?php foreach ($results['list'] as $row): ?>
            <div class="col-sm-4 mb-5">
                <div class="embed-responsive embed-responsive-16by9">
                <?= $row['embed_html'] ?>
                </div>
                <h3><?= $row['title'] ?></h3>
                <p>Description : <?= $row['description'] ?></p>
                <p>Status : <?= $row['status'] ?></p>
            </div>
            <?php endforeach; ?>
        <?php if ($results['has_more']): ?>
            <a class="btn btn-primary" href="<?= base_url('DailyMotionController/view_playlist/'.$code) ?>?page=<?= $page + 1 ?>">Halaman Selanjutnya</a>
        <?php endif ?>
        </div>
    </div>
</body>
</html>
