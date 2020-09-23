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
        <h3>Video Uploader</h3>
        <div class="row">
            <div class="col-sm-12">
                <form method="POST" action="<?= base_url("upload/do_upload") ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Judul</label>
                        <input class="form-control" name="title" id="title" type="text">
                    </div>

                    <div class="form-group">
                        <label>File Video</label>
                        <input class="file" name="video" type="file" size="32" />
                    </div>
                    <button class="btn btn-primary">Upload</button>
                </form>
                <br>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" id="upload-progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha512-YUkaLm+KJ5lQXDBdqBqk7EVhJAdxRnVdT2vtCzwPHSweCzyMgYV/tgGF4/dCyqtCC2eCphz0lRQgatGVdfR0ww==" crossorigin="anonymous"></script>
    <script>
        const progressBar = document.getElementById("upload-progress-bar");
        $('form').ajaxForm({
            beforeSend: function() {
                progressBar.style.width = `0%`;
                progressBar.innerHTML = `0%`;
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                progressBar.style.width = percentVal;
                progressBar.innerHTML = percentVal;
            },
            complete: function(xhr) {
                // Upload Selesai Redirect kehalaman
                const vid = xhr.responseJSON.data.videoId;
                const baseUrl = "<?= base_url("videos") ?>";
                window.location.replace(baseUrl + "/?vid=" + vid);
            }
        });
    </script>
</body>
</html>
