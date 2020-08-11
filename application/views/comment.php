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
    <h1>Comment Using AJAX</h1>
    <form class="form-comment">
        <div class="form-group">
            <textarea class="form-control" name="comment" placeholder="Komentar anda.."></textarea>
            <button type="submit" class="btn btn-danger btn-xs mt-2">Comment</button>
        </div>
    </form>
    <!-- Comment List -->
    <div class="comment-list">
       <?= $commentHtml ?>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(function () {
        const commentList = $('.comment-list');

        // Submit Form dan tampilkan komentar
        $('.form-comment').on('submit', function (e) {
            e.preventDefault();
            const comment = $(this).find('textarea').val();
            const data = $(this).serialize();

            // Kirim Informasi ke server
            $.post("<?= base_url("comment/do_comment") ?>", data, function (response) {
                commentList.prepend(commentBlock(comment, "User Here", response.data.id))
            });

            // Bersihkan text dalam textarea
            $(this).find('textarea').val("");

            // fokus cursor pada text area
            $(this).find('textarea').focus();
        })

        $(document).on('click', '.reply-btn', function (e) {
            e.preventDefault()
            // Show Reply Form
            $(this).parent().append(renderReplyForm($(this).data('comment')))
            let commentSource = $(this).parent()
            // Add Event
            $('.form-comment-reply').on('submit', function (e) {
                e.preventDefault();
                const comment = $(this).find('textarea').val();
                const data = $(this).serialize();

                $.post("<?= base_url("comment/do_comment") ?>", data, function (response) {
                    commentSource.append(commentBlock(comment, "User Here", response.data.id))
                });
                // Bersihkan text dalam textarea
                $(this).find('textarea').val("");

                // fokus cursor pada text area
                $(this).find('textarea').focus();
            })
        })
    })

    function renderReplyForm(parent_id) {
        return `<form class="form-comment-reply">
        <div class="form-group">
            <input type="hidden" name="parent_id" value="${parent_id}">
            <textarea class="form-control" name="comment" placeholder="Komentar anda.."></textarea>
            <button type="submit" class="btn btn-danger btn-xs mt-2">Comment</button>
        </div>
    </form>`
    }

    function commentBlock(comment, name, id) {
        return `<div class="media m-2">
                <img class="mr-3 img-fluid" width="64" src="https://randomuser.me/api/portraits/lego/2.jpg"
                     alt="Generic placeholder image">
                <div class="media-body">
                    <h5 class="mt-0">${name}</h5>
                   ${comment}
<br>
<a href="#" class="reply-btn" data-comment="${id}">Reply</a>
                </div>
            </div>`;
    }
</script>
</body>
</html>
