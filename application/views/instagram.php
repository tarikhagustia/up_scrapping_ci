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
        <h3>Instagram Searching User, Location <?= $this->input->get('locale') ?></h3>
        <form method="get">
            <input class="form-control" placeholder="Search .." name="q" value="<?= $this->input->get('q') ?>">
        </form>
        <h3>Users</h3>
        <div class="row">
            <?php foreach ($results->users as $i):?>
                <div class="col-sm-4">
                    <div class="card">
                        <img class="card-img-top" src="<?= $i->user->profile_pic_url ?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?= $i->user->username ?></h5>
                            <p class="card-text"><?= $i->user->full_name ?></p>
                        </div>
                    </div>
                    <br>
                </div>
            <?php endforeach ?>
        </div>

        <div class="row">
            <?php foreach ($results->places as $i):?>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $i->place->title ?></h5>
                        </div>
                    </div>
                    <br>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</body>
</html>
