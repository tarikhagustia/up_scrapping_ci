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
                <img src="<?= $v->cover ?>" class="img-fluid img-play" data-url="<?= $v->url ?>">
                <a href="/tiktok/video?url=<?= $v->url ?>">View / Download</a>
            </div>
            <?php endforeach; ?>

        </div>
        <?php endforeach; ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(function(){
            $('.img-play').hover(function (e) {
                const videoUrl = $(this).data('url')
                const that = this
                $.getJSON("<?= base_url('tiktok/getVideoMeta?url=') ?>" + videoUrl, function(json){
                    // Hide this image and display video

                    const html = `
<div class="embed-responsive embed-responsive-1by1">
 <video width="${json.videoMeta.width}" height="${json.videoMeta.height}" controls>
                            <source src="${json.videoUrl}" type="video/mp4">
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
