<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<body>
    <div class="container">
        <h1>Create Live Stream</h1>
        <form method="post" action="<?= base_url('DailyMotionController/start_live') ?>">
            <div class="form-group">
                <label class="control-label">Title</label>
                <input class="form-control" placeholder="Title" name="title">
            </div>

            <div class="form-group">
                <label class="control-label">Description</label>
                <textarea class="form-control" name="description" placeholder="Description of video"></textarea>
            </div>

            <div class="form-group">
                <label class="control-label">Start Time</label>
                <input class="datetimepicker" name="startTime" width="276" />
            </div>

            <div class="form-group">
                <label class="control-label">End Time</label>
                <input class="datetimepicker_2" name="endTime" width="276" />
            </div>

            <div class="form-group">
                <button class="btn btn-primary">Create Live Stream</button>
            </div>
        </form>
    </div>
    <script>
        $('.datetimepicker').datetimepicker({ footer: true, modal: true });
        $('.datetimepicker_2').datetimepicker({ footer: true, modal: true });
    </script>
</body>
</html>
