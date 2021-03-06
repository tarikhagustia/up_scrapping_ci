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
                <img src="<?= $row['thumbnail_url'] ?>" class="img-fluid">
                <h3><?= $row['name'] ?></h3>
                <a href="<?= base_url('DailyMotionController/view_playlist/'.$row['id']) ?>">View</a>
                <p>Description : <?= $row['description'] ?></p>
                <p>Total Video : <?= $row['videos_total'] ?></p>
                <ul>
                    <?php foreach ($row['videos'] as $v): ?>
                    <li><?= $v['title'] ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endforeach; ?>
        <?php if ($results['has_more']): ?>
            <a class="btn btn-primary" href="<?= base_url('DailyMotionController/playlist') ?>?page=<?= $page + 1 ?>">Halaman Selanjutnya</a>
        <?php endif ?>
        </div>
    </div>
</body>
</html>
