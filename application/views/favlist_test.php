<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Welcome to CodeIgniter</title>
    <link rel="shortcut icon" href="https://apa.id/dev/assets/images/favico.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="<?= $this->config->item('domainku'); ?>assets/css/bootstrap.min.css"/>
    <link rel="stylesheet"
          href="<?= $this->config->item('domainku'); ?>assets/font-awesome/4.5.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?= $this->config->item('domainku'); ?>assets/css/ace.min.css"
          class="ace-main-stylesheet" id="main-ace-style"/>
    <script src="<?= $this->config->item('domainku'); ?>assets/js/jquery.min.js"></script>
<body>
<div class="container">
    <h3>INput Favorite list</h3>
    <div class="row">
        <div class="col-sm-12">
            <button type="button" class="btn-fav" id="submit-p"
                    style="background-color:transparent; border:0px solid transparent!important; padding:0px; margin:0px;outline: 0"
                    toggle="#toggle-fav"><i class="ace-icon fa fa-heart-o toggle-fav"
                                            style="font-size:18px; cursor:pointer; font-weight:bold"></i></button>

            <button type="button" class="btn-fav" id="submit-p"
                    style="background-color:transparent; border:0px solid transparent!important; padding:0px; margin:0px;outline: 0"
                    toggle="#toggle-fav"><i class="ace-icon fa fa-heart-o toggle-fav"
                                            style="font-size:18px; cursor:pointer; font-weight:bold"></i></button>
            <script>
                $(document).ready(function () {
                    $(".btn-fav").on('click', function (e) {
                        e.preventDefault();
                        var title = $("#js_personal_title").val();
                        let btn = $(this);
                        $.ajax({
                            type: "POST",
                            url: '<?php echo base_url() ?>favlist/save',
                            data: {title: title},
                            success: function (data) {
                                // rubah class langsung
                                btn.find('.toggle-fav').toggleClass("fa fa-heart-o fa fa-heart red");
                            },
                            error: function () {
                                alert('fail');
                            }
                        });

                        //$(".toggle-fav").click(function() {
                        //	$(this).toggleClass("fa fa-heart-o fa fa-heart red");
                        //});
                    });
                });
            </script>
        </div>
    </div>
</div>
</body>
</html>
