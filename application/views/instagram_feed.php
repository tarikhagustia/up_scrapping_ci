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
        <h3>Instagram Feed By Hashtag</h3>
        <form method="get">
            <input class="form-control" placeholder="Hashtag wuthout # .." name="q" value="<?= $this->input->get('q') ?>">
        </form>
        <h3>Users</h3>
        <div class="row">
            <?php foreach ($results->edge_hashtag_to_media->edges as $i):?>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <img class="img-fluid <?= ($i->node->__typename == "GraphVideo") ? 'img-play' : null ?>" src="<?= $i->node->display_url ?>" data-url="<?= $i->node->shortcode ?>" alt="Card image cap">
                            <h5 class="card-title"><?= $i->node->__typename ?></h5>
                            <p class="card-text"><?= $i->node->edge_media_to_caption->edges[0]->node->text ?></p>
                        </div>
                        <div class="card-footer">
                            <a href="/instagram?code=<?= $i->node->shortcode ?>">View Detail</a>
                        </div>
                    </div>
                    <br>
                </div>
            <?php endforeach ?>
        </div>

        <div class="row">
            <?php /*var_dump($results->places); foreach ($results->places as $i):?>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $i->places->title ?></h5>
                        </div>
                    </div>
                    <br>
                </div>
            <?php endforeach*/ ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(function(){
            $('.img-play').hover(function (e) {
                const videoUrl = $(this).data('url')
                const that = this
                $.getJSON("<?= base_url('instagram?code=') ?>" + videoUrl + '&json=true', function(json){
                    // Hide this image and display video

                    const html = `
<div class="embed-responsive embed-responsive-1by1">
 <video width="${json.dimensions.width}" height="${json.dimensions.height}" controls>
                            <source src="${json.video_url}" type="video/mp4">
                        </video>
</div>

                    `;
                    console.log(html)
                    $(that).parent().append(html)
                    $(that).remove()
                })
            })
        })
    </script>
</body>
</html>
