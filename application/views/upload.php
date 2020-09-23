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
	<div><a href="<?= base_url("upload/new") ?>">Tambah</a></div>
	<table class="table table-striped table-hover" width="100%">
		<thead>
			<tr>
				<th width="5%" class="center">No</th>
				<th width="51%" class="center">Title</th>
				<th width="24%" class="center">Caption</th>
				<th width="20%" class="center">Url</th>
			</tr>
		</thead>
		<tbody>
			<?php 	
			$sql = "select * from vidaggrlib_2020 where vidaggrlib_status	='Active'";
        $query = $this->db->query($sql);			
				$no = 0;
				foreach ($query->result_array() as $row){
				$idx = $row['vidaggrlib_id'];
				$title = $row['vidaggrlib_title'];
				$captiondefault = $row['vidaggrlib_captiondefault'];
				$urldefault = $row['vidaggrlib_urldefault'];
			?>
			<tr>
				<td align="right"><?= $no; ?>.&nbsp;</td>
				<td><?= $title; ?></td>
				<td align="center"><?= $captiondefault; ?></td>
				<td align="center"><?= $urldefault; ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table></div>
</body>
</html>
