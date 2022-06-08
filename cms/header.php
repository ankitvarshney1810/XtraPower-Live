<?php require '../functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>XtraPower CMS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

    <nav class="navbar navbar-expand-sm bg-secondary navbar-dark">
        <a class="navbar-brand" href="<?=WEB_URL ?>">
            <img src="<?=WEB_URL ?>assets/img/logo.png" alt="Logo" style="width:40px;">
        </a>
        <ul class="navbar-nav">
            <li class="nav-item active"><a class="nav-link" href="<?=WEB_URL ?>cms/news-events.php">News And Events</a></li>
        </ul>
    </nav>