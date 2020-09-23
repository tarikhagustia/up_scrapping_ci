<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome to CodeIgniter</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<body>
<div class="container">
    <h3>Video Detail : <?= $result->title ?></h3>
    <div class="row">
        <div class="col-sm-12">
            <p>Filename : <?= $result->original_filename ?></p>
            <p>MimeType : <?= $result->mimetype ?></p>
            <p>Encoding : <?= $result->encoding ?></p>
            <p class="status">Status : <?= $result->status ?></p>
            <p>Duration : <?= $result->duration ?> Detik</p>

            <?php if ($result->status != 'Published'): ?>
            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" id="upload-progress-bar"
                     role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%
                </div>
            </div>
            <?php endif; ?>
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
            <iframe class="embed-responsive-item" src="<?= $this->scrapping->getAsset($f->file_url) ?>"
                    allowfullscreen></iframe>
        </div>
    <?php endforeach; ?>
    <br>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<?php if ($result->status != 'Published'): ?>
<script>
    $(function () {
        const progressBar = document.getElementById("upload-progress-bar");
        let finished = false;
        const interval = setInterval(function () {
            const currentWidth = parseInt(progressBar.style.width);
            if (currentWidth >= 90) {

            } else {
                progressBar.style.width = `${currentWidth + 1}%`;
                progressBar.innerHTML = `${currentWidth + 1}%`;
            }

            $.getJSON("<?= base_url("upload/check_status/".$result->id) ?>", function (res, error) {
                if (res.status == "Published") {
                    progressBar.style.width = `100%`;
                    progressBar.innerHTML = `100%`;
                    $('.Published').html(res.status)
                    clearInterval(interval)

                    location.reload();
                }
            })

        }, 1000)



    })

</script>
<?php
endif;
?>
</body>
</html>
